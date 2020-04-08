@extends('layouts.layout_main')

@section('content')

  <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " />

  <script src="{{url('/public/js/printReport/printReport.js')}} "></script>
@php
  $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
@endphp

<div class="row">
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

  <h5 class="text-center"><strong>ТАВАНТОЛГОЙ-ЗҮҮНБАЯН ЧИГЛЭЛИЙН 416.165  КМ ТӨМӨР ЗАМЫН ШУГАМЫН ДООД БҮТЦИЙН ГАЗАР ШОРООНЫ АЖЛЫН МЭДЭЭ</strong></h5>


  <h6 class="text-right">2020 оны  03 дугаар сарын 29-ний өдрөөс 04 дүгээр сарын 03-ний өдөр</h6>
  @php
    $hesegs = \App\Http\Controllers\HesegController::getHeseg();
  @endphp

  @foreach ($hesegs as $heseg)
    @php
      $companies = \App\Http\Controllers\companyController::getCompanyByHeseg($heseg->id);
    @endphp
    <h6 class="text-left">{{$heseg->name}}</h6>
    <div class="scrollable-table">
    <table id="davaa" border="1" class="table table-striped table-header-rotated">
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
            <th class="rotate-45"><div><span>{{$company->companyName}}</span></div></th>
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
    <div>
  @endforeach

@endsection
