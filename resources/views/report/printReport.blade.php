@extends('layouts.layout_print')

@section('content')

  {{-- <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " /> --}}
  <script src="{{url('/public/js/row-merge/jquery.rowspanizer.min.js')}} "></script>
  <script src="{{url('/public/js/printReport/printReport.js')}} "></script>
@php
  $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
  $companies1 = \App\Http\Controllers\companyController::getCompaniesJson();
@endphp


<script>
    var workTypes = {!! json_encode($workTypes->toArray()) !!};
    var companies = {!! json_encode($companies1->toArray()) !!};
    var workType = {{$workTypeID}};
</script>
<style>

@media print {
  /* body * {
    visibility: hidden;
  } */


   #onlyPrint {
    visibility: visible;
    width: 100%;
  }
  #hideRowBeforPrint{
    display: none;
  }

  #clear{
    display: none;
  }
}
</style>

<div class="row" id="hideRowBeforPrint">
  <div class="col-md-12 ">
    <h4 class="text-center"><strong class="text-danger">Хэвлэхдээ ажлын төрлөө сонгоод хэвлэх товч дарна уу </strong></h4>
  </div>
  @foreach ($workTypes as $workType)
    <div class="col-md-12">
        <label class="checkbox-inline"><input class="" name="radWorkType" type="radio" workTypeId="{{$workType->id}}" id="checkWorkType{{$workType->id}}">{{$workType->name}}</label>
    </div>
    <div class="col-md-12 vision" style="display:none; border: 1px solid grey; margin-top: 5px; border-radius: 5px; border-color: #d1cfcf;" id="worktypeid{{$workType->id}}">
      @php
        $works = \App\Http\Controllers\WorkController::getCompactWorks($workType->id);
      @endphp
      @foreach ($works as $work)
        <label class="checkbox-inline"><input type="checkbox" class="checkWork" workId="{{$work->id}}" id="checkWork{{$work->id}}" checked>  {{$work->name}}</label>
      @endforeach
    </div>
  @endforeach
  <div class="clearfix"></div>
  {{-- <input type="button" name="" id="btnUnmerge" value="Unmerge hiiih" />
  <input type="button" name="" id="btnMerge" value="Merge hiiih" /> --}}
  <div class="col-md-12 col-md-offset-5">
    <input type="button" class="btn btn-primary" redurl="{{url("/report/print")}}/" name="" id="btnPrint" value="Хэвлэх">
  </div>

</div>
@php
  $works = \App\Http\Controllers\WorkController::getWorksAll($workTypeID);
@endphp
<div id="onlyPrint">

  <h5 class="text-center"><strong>ТАВАНТОЛГОЙ-ЗҮҮНБАЯН ЧИГЛЭЛИЙН 416.165  КМ ТӨМӨР ЗАМЫН ШУГАМЫН ДООД БҮТЦИЙН ГАЗАР ШОРООНЫ АЖЛЫН МЭДЭЭ</strong></h5>
  @php
    $date = \App\Http\Controllers\ReportTimeController::getLastDate();
    $splitDates = explode('&',$date);
    $startDate = $splitDates[0];
    $endDate = $splitDates[1];
    $splitStartDate = explode('-',$startDate);
    $splitEndDate = explode('-',$endDate);
  @endphp
  <p class="text-right"><h6 class="text-right">{{$splitStartDate[0]}} оны {{$splitStartDate[1]}} сарын {{$splitStartDate[2]}} өдрөөс {{$splitEndDate[0]}} оны {{$splitEndDate[1]}} сарын {{$splitEndDate[2]}} өдрийн тайлан</h6></p>

  @php
    $hesegs = \App\Http\Controllers\HesegController::getHesegByAdmin();
    $j=0;
  @endphp

  @foreach ($hesegs as $heseg)
    <div class="row">
    @php
      $companies = \App\Http\Controllers\companyController::getCompanyByHeseg($heseg->id);
      $j++;
      if($j == 3){
        $widthNumber = 9;
      }
      else{
        $widthNumber = 12;
      }
    @endphp
    <h6 class="text-center"><strong>{{$heseg->name}}</strong></h6>


    {{-- <table id="davaa" border="1" class="table table-striped table-header-rotated"> --}}
  <div class="col-md-{{$widthNumber}} text-center">
    <table border="1" class="table{{$heseg->id}}">
      <thead>
        <tr class="text-left">
          <th colspan="2" rowspan="2" class="text-center">Мэдээ агуулга</th>
          <th colspan="{{$companies->count()+1}}" class="text-center">Ажил гүйцэтгэх Зэвсэгт хүчний анги, туслан гүйцэтгэгч аж ахуйн нэгж байгууллага</th>
        </tr>
        <tr class="text-left">
          @foreach ($companies as $company)
            <th class="verticalTD  text-center"><div class="rotate">{{$company->companyName}}</div></th>
            {{-- <th class="rotate">{{$company->companyName}}</th> --}}
          @endforeach
          <th class="text-center" rowspan="3">Бүгд</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Хариуцах ПК-ийн байршил</td>
          @foreach ($companies as $company)
            <th class="rotate-45 text-center"><div><span>{{$company->ajliinHeseg}}</span></div></th>
          @endforeach
          <th class="text-center">{{$heseg->ajliinHeseg}}</th>
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Батлагдсан тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id, $workTypeID);
            @endphp
            <th class="colComID{{$company->id}} allPlan text-center"><div><span>{{round($sumPlan, 1)}}</span></div></th>
          @endforeach
          @php
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          <th class="text-center">{{round($plan, 1)}}</th>
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2019 оны гүйцэтгэл /хувь/</td>
          @foreach ($companies as $company)
            @php
              $percent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByCompany2019($company->id, $workTypeID);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{round($percent2019, 1) . "%"}}</span></div></th>
          @endforeach
          @php
            $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg->id, $workTypeID);
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          @if ($plan == 0)
            <th class="text-center">0%</th>
          @else
            <th class="text-center">{{round($per2019*100/$plan, 1)}}%</th>
          @endif
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $execution2020 = \App\Http\Controllers\ExecutionContoller::getSumExecutionByCompany2020($company->id, $workTypeID);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{round($execution2020, 1)}}</span></div></th>
          @endforeach
          @php
          $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg->id, $workTypeID);
          $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          <th class="text-center">{{round($plan-$per2019, 1)}}</th>
        </tr>
        <tr class="text-center">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Хүн</td>
          @foreach ($companies as $company)
            @php
              $hun = \App\Http\Controllers\hunHuchController::getHumanByCompany($company->id);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$hun}}</span></div></th>
          @endforeach
          <th class="text-center"></th>
        </tr>
        <tr class="text-center">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Машин техник</td>
          @foreach ($companies as $company)
            @php
              $car = \App\Http\Controllers\hunHuchController::getCarByCompany($company->id);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$car}}</span></div></th>
          @endforeach
          <th class="text-center"></th>
        </tr>

        @foreach($works as $work)
          <tr class="{{$work->work_type_id}} workType text-left" id="prev{{$work->id}}">
            {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
            <td class="text-center">{{$work->name}}</td>
            <td class="text-center">Өмнөх тайлангийн бүгд</td>
            @foreach ($companies as $company)
              @php
                $previousReportExecution = \App\Http\Controllers\ExecutionContoller::previousReportExecutionByComIdWorkID($company->id, $work->id);
              @endphp
              @if($previousReportExecution == 0)
                <td class="colComID{{$company->id}} previousExec{{$work->work_type_id}} text-center"></td>
              @else
                <td class="colComID{{$company->id}} previousExec{{$work->work_type_id}} text-center">{{round($previousReportExecution, 1)}}</td>
              @endif
            @endforeach
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg->id, $work->id);
              $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecution2020ByHeseg($heseg->id, $work->id);
            @endphp
            <td class="text-center">{{round($allExec - $previousReportExecution, 1)}}</td>
          </tr>
          <tr class="{{$work->work_type_id}} workType text-left" id="report{{$work->id}}">
            {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
            <td class="text-center">{{$work->name}}</td>
            <td class="text-center">Тайлант үеийн</td>
            @foreach ($companies as $company)
              @php
                $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComIdWorkID($company->id, $work->id);
              @endphp
              @if($lastExec == 0)
                <td class="colComID{{$company->id}} reportExec{{$work->work_type_id}} text-center"></td>
              @else
                <td class="colComID{{$company->id}} reportExec{{$work->work_type_id}} text-center">{{round($lastExec, 1)}}</td>
              @endif
            @endforeach
            <td class="text-center">{{round($previousReportExecution, 1)}}</td>
          </tr>
        @endforeach

        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Өмнөх тайлангийн нийт бүгд</td>
          @foreach ($companies as $company)
            @php
              $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByReportTime($company->id, $workTypeID);
              $allReportExecution = \App\Http\Controllers\ExecutionContoller::getSumExec2020ByCompany($company->id, $workTypeID);
            @endphp
            @if(($allReportExecution-$lastExec) <=0 )
              <td class="colComID{{$company->id}} sumReportExec{{$company->id}} text-center"></td>
            @else
              <td class="colComID{{$company->id}} sumReportExec{{$company->id}} text-center">{{round($allReportExecution-$lastExec, 1)}}</td>
            @endif
          @endforeach
          @php
            $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByHesegReportTime($heseg->id, $workTypeID);
            $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExec2020ByHeseg($heseg->id, $workTypeID);
          @endphp
          <td class="text-center">{{round($allExecByHeseg-$lastExec, 1)}}</td>
        </tr>

        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Тайлант үеийн нийт</td>
          @foreach ($companies as $company)
            @php
              $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByReportTime($company->id, $workTypeID);
            @endphp
            @if($lastExec == 0)
              <td class="colComID{{$company->id}} sumReportExec{{$company->id}} text-center"></td>
            @else
              <td class="colComID{{$company->id}} sumReportExec{{$company->id}} text-center">{{round($lastExec, 1)}}</td>
            @endif
          @endforeach
          @php
            $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByHesegReportTime($heseg->id, $workTypeID);
          @endphp
          <td class="text-center">{{round($lastExec, 1)}}</td>
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">2020 оны тоо /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $allReportExecution = \App\Http\Controllers\ExecutionContoller::getAllExec2020ByCompany($company->id, $workTypeID);
            @endphp
            <td class="text-center">{{round($allReportExecution, 1)}}</td>
          @endforeach
          @php
            $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExec2020ByHeseg($heseg->id, $workTypeID);
          @endphp
          <td class="text-center">{{round($allExecByHeseg, 1)}}</td>
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">2020 оны нийт хувь</td>
          @foreach ($companies as $company)
            @php
              $execPercent2020 = \App\Http\Controllers\ExecutionContoller::getAllExecPercent2020($company->id, $workTypeID);
            @endphp
            <td>{{round($execPercent2020, 1)}}%</td>
          @endforeach
            @php
              $execPercent2020 = \App\Http\Controllers\ExecutionContoller::getAllHesegExecPercent2020($heseg->id, $workTypeID);
            @endphp
            <td class="text-center">{{round($execPercent2020, 1)}}%</td>
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Нийт хувь</td>
          @foreach ($companies as $company)
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::getAllExecByCompany($company->id, $workTypeID);
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id, $workTypeID);
            @endphp
            @if($sumPlan == 0)
              <td class="text-center"></td>
            @else
              <td class="text-center">{{round($previousReportExecution*100/$sumPlan, 1)}}%</td>
            @endif
          @endforeach
          @php
            $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg->id, $workTypeID);
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          @if($plan == 0)
            <td></td>
          @else
            <td class="text-center">{{round($allExecByHeseg*100/$plan, 1)}}%</td>
          @endif
        </tr>
      </tbody>
    </table>
    </div>
    {{-- end first div --}}





    @if($j==3)
      <div class="clearfix" id="clear"></div>
      <div class="col-md-3">
        <table  border="1" class="allTable">
          <thead>
            <tr>
              <th class="text-center" colspan="{{$hesegs->count()+3}}">МЭДЭЭНИЙ ТОВЧОО</th>
            </tr>
            <tr>
              <th colspan="2"></th>
              @foreach ($hesegs as $heseg1)
                <th class="text-center">{{$heseg1->name}}</th>
              @endforeach
              <th class="text-center">Бүгд</th>
            </tr>
            <tr>
              <th class="text-center" colspan="2">Хариуцах ПК-ийн байршил</th>
              @foreach ($hesegs as $heseg1)
                <th class="text-center">{{$heseg1->ajliinHeseg}}</th>
              @endforeach
              <th></th>
            </tr>
            <tr id="lastTablePlanRow" class="text-center">
              <th class="text-center" colspan="2">Батлагдсан тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
                @endphp
                @if ($plan == null || $plan == "")
                  <th class="sum" class="text-center">0</th>
                @else
                  <th class="sum" class="text-center">{{round($plan, 1)}}</th>
                @endif
              @endforeach
              <th class="text-center" id="lastTableSumPlan"></th>
            </tr>
            <tr id="lastTableExecPercent2019Row">
              <th class="text-center" colspan="2">2019 оны гүйцэтгэл /хувь/</th>
              @foreach ($hesegs as $heseg1)
              @php
                $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id, $workTypeID);
                $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
              @endphp
                @if ($plan == null || $plan == "")
                  <th class="text-center">0</th>
                @else
                  <th class="text-center">{{round($per2019*100/$plan, 1)}}</th>
                @endif
              @endforeach
              <th class="text-center" id="lastTableSumExecPercent2019"></th>
            </tr>
            <tr id="lastTableExec2020Row">
              <th class="text-center" colspan="2">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id, $workTypeID);
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
                @endphp
                <th class="sum text-center">{{round($plan-$per2019, 1)}}</th>
              @endforeach
              <th class="text-center" id="lastTableSumExec2020"></th>
            </tr>
          </thead>
          <tbody>
            @php
              $heseg1s = \App\Http\Controllers\HesegController::getHeseg();
            @endphp
            @foreach ($works as $work)
              <tr class="{{$work->work_type_id}} workType text-center" class="{{$work->work_type_id}}" id="prev{{$work->id}}">
                <td class="text-center">{{$work->name}}</td>
                <td class="text-center">Өмнөх тайлангийн бүгд</td>
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecution2020ByHeseg($heseg1->id, $work->id);
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{round($allExec-$lastExec, 1)}}</td>
                @endforeach
                <td class="text-center"></td>
              </tr>
              <tr class="{{$work->work_type_id}} workType" id="report{{$work->id}}">
                <td class="text-center">{{$work->name}}</td>
                <td class="text-center">Тайлант үеийн</td>
                @foreach ($heseg1s as $heseg1)
                  @php
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{round($lastExec, 1)}}</td>
                @endforeach
                <td class="text-center"></td>
              </tr>
            @endforeach
              <tr class="text-center">
                <td>Бүгд</td>
                <td>Өмнөх тайлангийн нийт</td>
                @php
                  $sumPreviousExecOfHesegs=0;
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExec2020ByHeseg($heseg1->id, $workTypeID);
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByHesegReportTime($heseg1->id, $workTypeID);
                    $sumPreviousExecOfHesegs = $sumPreviousExecOfHesegs + ($allExecByHeseg-$lastExec);
                  @endphp
                  <td class="text-center">{{round($allExecByHeseg-$lastExec, 1)}}</td>
                @endforeach
                <td class="text-center">{{round($sumPreviousExecOfHesegs, 1)}}</td>
              </tr>
              <tr class="text-center">
                <td>Бүгд</td>
                <td>Тайлант үеийн</td>
                @php
                  $sumLastExecOfHesegs=0;
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getAllExecByHesegReportTime($heseg1->id, $workTypeID);
                    $sumLastExecOfHesegs = $sumLastExecOfHesegs + $lastExec;
                  @endphp
                  <td class="text-center">{{round($lastExec, 1)}}</td>
                @endforeach
                <td class="text-center">{{round($sumLastExecOfHesegs, 1)}}</td>
              </tr>
              <tr class="allSumLastTable text-center">
                <td>Бүгд</td>
                <td>2020 оны тоо /м.куб/</td>
                @php
                  $sumExecByHesegs=0;
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExec2020ByHeseg($heseg1->id, $workTypeID);
                    $sumExecByHesegs = $sumExecByHesegs + $allExecByHeseg;
                  @endphp
                  <td>{{round($allExecByHeseg, 1)}}</td>
                @endforeach
                <td class="text-center">{{round($sumExecByHesegs, 1)}}</td>
              </tr>
              <tr class="allSumLastTable text-center">
                <td>Бүгд</td>
                <td>2020 оны нийт хувь</td>
                @php
                  $sumExecByHesegs2020=0;
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $execPercent2020 = \App\Http\Controllers\ExecutionContoller::getAllHesegExecPercent2020($heseg1->id, $workTypeID);
                    $sumExecByHesegs2020 = $sumExecByHesegs2020 + $execPercent2020;
                  @endphp
                  <td class="text-center">{{round($execPercent2020, 1)}}%</td>
                @endforeach
                @php
                  $execPercent2020 = \App\Http\Controllers\ExecutionContoller::getAllHesegExec2020Percent($workTypeID);
                @endphp
                <td class="text-center">{{round($execPercent2020, 1)}}%</td>
              </tr>
              <tr class="allSumLastTable text-center">
                <td>Бүгд</td>
                <td>Нийт хувь</td>
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg1->id, $workTypeID);
                    $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
                  @endphp
                  @if ($plan == 0)
                    <td class="text-center">0</td>
                  @else
                    <td class="text-center">{{round($allExecByHeseg*100/$plan, 1)}}%</td>
                  @endif
                @endforeach
                @php
                  $allExecPercent = \App\Http\Controllers\ExecutionContoller::getAllHesegExecPercent($workTypeID);
                @endphp
                <td class="text-center">{{round($allExecPercent, 1)}}%</td>
              </tr>
          </tbody>
        </table>
      </div>
    @endif

  </div>
  {{-- end row div --}}
  @endforeach

  </div>
@endsection
