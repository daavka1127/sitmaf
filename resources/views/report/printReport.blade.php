@extends('layouts.layout_print')

@section('content')

  {{-- <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " /> --}}
  <script src="{{url('/public/js/row-merge/jquery.rowspanizer.min.js')}} "></script>
  <script src="{{url('/public/js/printReport/printReport.js')}} "></script>
@php
  $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
@endphp
<script>
    var workTypes = {!! json_encode($workTypes->toArray()) !!};
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
  <input type="button" name="" id="btnUnmerge" value="Unmerge hiiih" />
  <input type="button" name="" id="btnMerge" value="Merge hiiih" />
</div>
<div id="onlyPrint">

  <h5 class="text-center"><strong>ТАВАНТОЛГОЙ-ЗҮҮНБАЯН ЧИГЛЭЛИЙН 416.165  КМ ТӨМӨР ЗАМЫН ШУГАМЫН ДООД БҮТЦИЙН ГАЗАР ШОРООНЫ АЖЛЫН МЭДЭЭ</strong></h5>


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
    <h6 class="text-left">{{$heseg->name}}</h6>


    {{-- <table id="davaa" border="1" class="table table-striped table-header-rotated"> --}}
  <div class="col-md-{{$widthNumber}} text-center">
    <table border="1" class="table{{$heseg->id}}">
      <thead>
        <tr class="text-left">
          <th colspan="2" rowspan="2" class="text-center">Мэдээ агуулга</th>
          <th colspan="{{$companies->count()}}" class="text-center">Ажил гүйцэтгэх Зэвсэгт хүчний анги, туслан гүйцэтгэгч аж ахуйн нэгж байгууллага</th>
        </tr>
        <tr class="text-left">
          @foreach ($companies as $company)
            <th class="verticalTD  text-center"><div class="rotate">{{$company->companyName}}</div></th>
            {{-- <th class="rotate">{{$company->companyName}}</th> --}}
          @endforeach
        </tr>
      </thead>
      <tbody>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Хариуцах ПК-ийн байршил</td>
          @foreach ($companies as $company)
            <th class="rotate-45 text-center"><div><span>{{$company->ajliinHeseg}}</span></div></th>
          @endforeach
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">Батлагдсан тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$sumPlan}}</span></div></th>
          @endforeach
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2019 оны гүйцэтгэл /хувь/</td>
          @foreach ($companies as $company)
            @php
              $percent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByCompany2019($company->id);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$percent2019}}</span></div></th>
          @endforeach
        </tr>
        <tr class="text-left">
          {{-- <td>Ерөнхий мэдээлэл</td> --}}
          <td colspan="2" class="text-center">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $execution2020 = \App\Http\Controllers\ExecutionContoller::getSumExecutionByCompany2020($company->id);
            @endphp
            <th class="rotate-45 text-center"><div><span>{{$execution2020}}</span></div></th>
          @endforeach
        </tr>
        @php
          $works = \App\Http\Controllers\WorkController::getWorksAll($company->id);
        @endphp

        @for($i=0; $i<$works->count(); $i++)
          <tr class="{{$works[$i]->work_type_id}} workType text-left" id="prev{{$works[$i]->id}}">
            {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
            <td class="text-center">{{$works[$i]->name}}</td>
            <td class="text-center">Өмнөх тайлангийн бүгд</td>
            @foreach ($companies as $company)
              @php
                $previousReportExecution = \App\Http\Controllers\ExecutionContoller::previousReportExecutionByComIdWorkID($company->id, $works[$i]->id);
              @endphp
              <td class="text-center">{{$previousReportExecution}}</td>
            @endforeach
          </tr>
          <tr class="{{$works[$i]->work_type_id}} workType text-left" id="report{{$works[$i]->id}}">
            {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
            <td class="text-center">{{$works[$i]->name}}</td>
            <td class="text-center">Тайлант үеийн</td>
            @foreach ($companies as $company)
              @php
                $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComIdWorkID($company->id, $works[$i]->id);
              @endphp
              <td class="text-center">{{$lastExec}}</td>
            @endforeach
          </tr>
        @endfor


        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Өмнөх тайлангийн бүгд</td>
          @foreach ($companies as $company)
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::previousReportExecutionByComId($company->id);
            @endphp
            <td class="text-center">{{$previousReportExecution}}</td>
          @endforeach
        </tr>
        <tr>
          {{-- <td>Мэдээний хугацаанд гүйцэтгэсэн</td> --}}
          <td class="text-center">Бүгд</td>
          <td class="text-center">Тайлант үеийн</td>
          @foreach ($companies as $company)
            @php
              $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComId($company->id);
            @endphp
            <td class="text-center">{{$lastExec}}</td>
          @endforeach
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
            <tr>
              <th class="text-center" colspan="2">Батлагдсан тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
                @endphp
                @if ($plan == null || $plan == "")
                  <th class="text-center">0</th>
                @else
                  <th class="text-center">{{round($plan, 2)}}</th>
                @endif
              @endforeach
              <th></th>
            </tr>
            <tr>
              <th class="text-center" colspan="2">2019 оны гүйцэтгэл /хувь/</th>
              @foreach ($hesegs as $heseg1)
              @php
                $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id);
                $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
              @endphp
                @if ($plan == null || $plan == "")
                  <th class="text-center">0</th>
                @else
                  <th class="text-center">{{round($per2019*100/$plan, 2)}}</th>
                @endif
              @endforeach
              <th></th>
            </tr>
            <tr>
              <th class="text-center" colspan="2">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id);
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
                @endphp
                <th class="text-center">{{$plan-$per2019}}</th>
              @endforeach
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
              $works = \App\Http\Controllers\WorkController::getWorksAll($company->id);
            @endphp
            @foreach ($works as $work)
              <tr class="{{$work->work_type_id}} text-center" class="{{$work->work_type_id}}" id="prev{{$work->id}}">
                <td class="text-center">{{$work->name}}</td>
                <td class="text-center">Өмнөх тайл бүгд</td>
                @php
                  $heseg1s = \App\Http\Controllers\HesegController::getHeseg();
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecutionByHeseg($heseg1->id, $work->id);
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{$allExec-$lastExec}}</td>
                @endforeach
                <td></td>
              </tr>
              <tr class="{{$work->work_type_id}}" id="report{{$work->id}}">
                <td class="text-center">{{$work->name}}</td>
                <td class="text-center">Тайлант үеийн</td>
                @php
                  $heseg1s = \App\Http\Controllers\HesegController::getHeseg();
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td class="text-center">{{$lastExec}}</td>
                @endforeach
                <td></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

  </div>
  {{-- end row div --}}
  @endforeach

  </div>
@endsection
