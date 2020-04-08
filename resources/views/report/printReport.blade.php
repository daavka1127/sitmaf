@extends('layouts.layout_print')

@section('content')

  <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " />

  <script src="{{url('/public/js/printReport/printReport.js')}} "></script>
@php
  $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
@endphp

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
        <label class="checkbox-inline"><input type="checkbox" workTypeId="{{$workType->id}}" id="checkWorkType{{$workType->id}}">  {{$workType->name}}</label>
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
  <div class="col-md-{{$widthNumber}}">
    <table border="1" class="table{{$heseg->id}}">
      <thead>
        <tr>
          <th>Мэдээ агуулга</th>
          <th>Мэдээ агуулга</th>
          <th>Мэдээ агуулга</th>
          <th colspan="{{$companies->count()}}">Ажил гүйцэтгэх Зэвсэгт хүчний анги, туслан гүйцэтгэгч аж ахуйн нэгж байгууллага</th>
        </tr>
        <tr>
          <th>Мэдээ агуулга</th>
          <th>Мэдээ агуулга</th>
          <th>Мэдээ агуулга</th>
          @foreach ($companies as $company)
            <th class="verticalTD"><div class="rotate">{{$company->companyName}}</div></th>
            {{-- <th class="rotate">{{$company->companyName}}</th> --}}
          @endforeach
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ерөнхий мэдээлэл</td>
          <td colspan="2">Хариуцах ПК-ийн байршил</td>
          @foreach ($companies as $company)
            <th class="rotate-45"><div><span>{{$company->ajliinHeseg}}</span></div></th>
          @endforeach
        </tr>
        <tr>
          <td>Ерөнхий мэдээлэл</td>
          <td colspan="2"> Батлагдсан тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $sumPlan = \App\Http\Controllers\planController::getSumPlanCompany($company->id);
            @endphp
            <th class="rotate-45"><div><span>{{$sumPlan}}</span></div></th>
          @endforeach
        </tr>
        <tr>
          <td>Ерөнхий мэдээлэл</td>
          <td colspan="2">2019 оны гүйцэтгэл /хувь/</td>
          @foreach ($companies as $company)
            @php
              $percent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByCompany2019($company->id);
            @endphp
            <th class="rotate-45"><div><span>{{$percent2019}}</span></div></th>
          @endforeach
        </tr>
        <tr>
          <td>Ерөнхий мэдээлэл</td>
          <td colspan="2">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</td>
          @foreach ($companies as $company)
            @php
              $execution2020 = \App\Http\Controllers\ExecutionContoller::getSumExecutionByCompany2020($company->id);
            @endphp
            <th class="rotate-45"><div><span>{{$execution2020}}</span></div></th>
          @endforeach
        </tr>
        @php
          $works = \App\Http\Controllers\WorkController::getWorksAll($company->id);
        @endphp

        @for($i=0; $i<$works->count(); $i++)
          <tr class="{{$works[$i]->work_type_id}}" id="prev{{$works[$i]->id}}">
            <td>Мэдээний хугацаанд гүйцэтгэсэн</td>
            <td>{{$works[$i]->name}}</td>
            <td>Өмнөх тайлангийн бүгд</td>
            @foreach ($companies as $company)
              @php
                $previousReportExecution = \App\Http\Controllers\ExecutionContoller::previousReportExecutionByComIdWorkID($company->id, $works[$i]->id);
              @endphp
              <td>{{$previousReportExecution}}</td>
            @endforeach
          </tr>
          <tr class="{{$works[$i]->work_type_id}}" id="report{{$works[$i]->id}}">
            <td>Мэдээний хугацаанд гүйцэтгэсэн</td>
            <td>{{$works[$i]->name}}</td>
            <td>Тайлант үеийн</td>
            @foreach ($companies as $company)
              @php
                $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComIdWorkID($company->id, $works[$i]->id);
              @endphp
              <td>{{$lastExec}}</td>
            @endforeach
          </tr>
        @endfor


        <tr>
          <td>Мэдээний хугацаанд гүйцэтгэсэн</td>
          <td>Бүгд</td>
          <td>Өмнөх тайлангийн бүгд</td>
          @foreach ($companies as $company)
            @php
              $previousReportExecution = \App\Http\Controllers\ExecutionContoller::previousReportExecutionByComId($company->id);
            @endphp
            <td>{{$previousReportExecution}}</td>
          @endforeach
        </tr>
        <tr>
          <td>Мэдээний хугацаанд гүйцэтгэсэн</td>
          <td>Бүгд</td>
          <td>Тайлант үеийн</td>
          @foreach ($companies as $company)
            @php
              $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecByComId($company->id);
            @endphp
            <td>{{$lastExec}}</td>
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
              <th colspan="{{$hesegs->count()+3}}">МЭДЭЭНИЙ ТОВЧОО</th>
            </tr>
            <tr>
              <th colspan="2"></th>
              @foreach ($hesegs as $heseg1)
                <th>{{$heseg1->name}}</th>
              @endforeach
              <th>Бүгд</th>
            </tr>
            <tr>
              <th colspan="2">Хариуцах ПК-ийн байршил</th>
              @foreach ($hesegs as $heseg1)
                <th>{{$heseg1->ajliinHeseg}}</th>
              @endforeach
              <th></th>
            </tr>
            <tr>
              <th colspan="2">Батлагдсан тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
                @endphp
                @if ($plan == null || $plan == "")
                  <th>0</th>
                @else
                  <th>{{round($plan, 2)}}</th>
                @endif
              @endforeach
              <th></th>
            </tr>
            <tr>
              <th colspan="2">2019 оны гүйцэтгэл /хувь/</th>
              @foreach ($hesegs as $heseg1)
              @php
                $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id);
                $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
              @endphp
                @if ($plan == null || $plan == "")
                  <th>0</th>
                @else
                  <th>{{round($per2019*100/$plan, 2)}}</th>
                @endif
              @endforeach
              <th></th>
            </tr>
            <tr>
              <th colspan="2">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</th>
              @foreach ($hesegs as $heseg1)
                @php
                  $per2019 = \App\Http\Controllers\planController::getExecPercent2019($heseg1->id);
                  $plan = \App\Http\Controllers\planController::getPlanSections($heseg1->id);
                @endphp
                <th>{{$plan-$per2019}}</th>
              @endforeach
              <th></th>
            </tr>
          </thead>
          <tbody>
            @php
              $works = \App\Http\Controllers\WorkController::getWorksAll($company->id);
            @endphp
            @foreach ($works as $work)
              <tr class="{{$work->work_type_id}}" id="prev{{$work->id}}">
                <td>{{$work->name}}</td>
                <td>Өмнөх тайл бүгд</td>
                @php
                  $heseg1s = \App\Http\Controllers\HesegController::getHeseg();
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $allExec = \App\Http\Controllers\ExecutionContoller::getAllExecutionByHeseg($heseg1->id, $work->id);
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td>{{$allExec-$lastExec}}</td>
                @endforeach
                <td></td>
              </tr>
              <tr class="{{$work->work_type_id}}" id="report{{$work->id}}">
                <td>{{$work->name}}</td>
                <td>Тайлант үеийн</td>
                @php
                  $heseg1s = \App\Http\Controllers\HesegController::getHeseg();
                @endphp
                @foreach ($heseg1s as $heseg1)
                  @php
                    $lastExec = \App\Http\Controllers\ExecutionContoller::getLastExecutionByHeseg($heseg1->id, $work->id);
                  @endphp
                  <td>{{$lastExec}}</td>
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
