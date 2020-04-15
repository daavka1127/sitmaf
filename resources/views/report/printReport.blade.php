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
    <input type="button" class="btn btn-primary" name="" id="btnPrint" value="Хэвлэх">
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
    $hesegs = \App\Http\Controllers\HesegController::getHeseg();
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
          <th rowspan="3">Бүгд</th>
        </tr>
      </thead>
      <tbody>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Хариуцах ПК-ийн байршил</td>
          @foreach ($companies as $company)
            <th class="rotate-45 text-center"><div><span>{{$company->ajliinHeseg}}</span></div></th>
          @endforeach
          <th>{{$heseg->ajliinHeseg}}</th>
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Батлагдсан тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id, $workTypeID);
            @endphp
            <th class="colComID{{$company->id}} allPlan text-center"><div><span>{{$sumPlan}}</span></div></th>
          @endforeach
          @php
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          <th>{{$plan}}</th>
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2019 оны гүйцэтгэл /хувь/</td>
          @foreach ($companies as $company)
            @php
              $percent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByCompany2019($company->id, $workTypeID);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$percent2019}}</span></div></th>
          @endforeach
          @php
            $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg->id, $workTypeID);
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          @if ($plan == 0)
            <th>0%</th>
          @else
            <th>{{round($per2019*100/$plan, 2)}}%</th>
          @endif
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $execution2020 = \App\Http\Controllers\ExecutionContoller::getSumExecutionByCompany2020($company->id, $workTypeID);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$execution2020}}</span></div></th>
          @endforeach
          @php
          $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg->id, $workTypeID);
          $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          <th>{{$plan-$per2019}}</th>
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
          <th></th>
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
          <th></th>
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
              <td class="colComID{{$company->id}} previousExec{{$work->work_type_id}} text-center">{{$previousReportExecution}}</td>
            @endforeach
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg->id, $work->id);
              $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecutionByHeseg($heseg->id, $work->id);
            @endphp
            <td>{{$allExec - $previousReportExecution}}</td>
          </tr>
          <tr class="{{$work->work_type_id}} workType text-left" id="report{{$work->id}}">
            {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
            <td class="text-center">{{$work->name}}</td>
            <td class="text-center">Тайлант үеийн</td>
            @foreach ($companies as $company)
              @php
                $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComIdWorkID($company->id, $work->id);
              @endphp
              <td class="colComID{{$company->id}} reportExec{{$work->work_type_id}} text-center">{{$lastExec}}</td>
            @endforeach
            <td>{{$previousReportExecution}}</td>
          </tr>
        @endforeach


        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Тайлант үеийн нийт</td>
          @foreach ($companies as $company)
            <td class="colComID{{$company->id}} sumReportExec{{$company->id}} text-center">{{$previousReportExecution}}</td>
          @endforeach
          <td></td>
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Тоо /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::getAllExecByCompany($company->id, $workTypeID);
            @endphp
            <td class="text-center">{{$previousReportExecution}}</td>
          @endforeach
          @php
            $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg->id, $workTypeID);
          @endphp
          <td>{{$allExecByHeseg}}</td>
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Хувь</td>
          @foreach ($companies as $company)
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::getAllExecByCompany($company->id, $workTypeID);
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id, $workTypeID);
            @endphp
            @if($sumPlan == 0)
              <td class="text-center"></td>
            @else
              <td class="text-center">{{round($previousReportExecution*100/$sumPlan, 2)}}%</td>
            @endif
          @endforeach
          @php
            $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg->id, $workTypeID);
            $plan = \App\Http\Controllers\planController::getPlanSections($heseg->id, $workTypeID);
          @endphp
          @if($plan == 0)
            <td></td>
          @else
            <td>{{round($allExecByHeseg*100/$plan, 2)}}%</td>
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
            <tr id="lastTablePlanRow">
              <th class="text-center" colspan="2">Батлагдсан тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
                @endphp
                @if ($plan == null || $plan == "")
                  <th class="sum" class="text-center">0</th>
                @else
                  <th class="sum" class="text-center">{{round($plan, 2)}}</th>
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
                  <th class="text-center">{{round($per2019*100/$plan, 2)}}</th>
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
                <th class="sum text-center">{{$plan-$per2019}}</th>
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
                    $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecutionByHeseg($heseg1->id, $work->id);
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{$allExec-$lastExec}}</td>
                @endforeach
                <td></td>
              </tr>
              <tr class="{{$work->work_type_id}} workType" id="report{{$work->id}}">
                <td class="text-center">{{$work->name}}</td>
                <td class="text-center">Тайлант үеийн</td>
                @foreach ($heseg1s as $heseg1)
                  @php
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{$lastExec}}</td>
                @endforeach
                <td></td>
              </tr>
            @endforeach
              <tr class="allSumLastTable text-center">
                <td>Бүгд</td>
                <td>Тоо /м.куб/</td>
                @php
                  $sumExecByHesegs=0;
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg1->id, $workTypeID);
                    $sumExecByHesegs = $sumExecByHesegs + $allExecByHeseg;
                  @endphp
                  <td>{{$allExecByHeseg}}</td>
                @endforeach
                <td>{{$sumExecByHesegs}}</td>
              </tr>
              <tr class="allSumLastTable text-center">
                <td>Бүгд</td>
                <td>Хувь</td>
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExecByHeseg = \App\Http\Controllers\ExecutionContoller::getAllExecByHeseg($heseg1->id, $workTypeID);
                    $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id, $workTypeID);
                  @endphp
                  @if ($plan == 0)
                    <td>0</td>
                  @else
                    <td>{{round($allExecByHeseg*100/$plan, 2)}}%</td>
                  @endif
                @endforeach
                @php
                  $allExecPercent = \App\Http\Controllers\ExecutionContoller::getAllExecPercent();
                @endphp
                <td>{{round($allExecPercent, 2)}}%</td>
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
