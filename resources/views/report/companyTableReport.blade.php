@extends('layouts.layout_main')

@section('content')
  <script>


  </script>

  <style>
  .table-div{
    overflow:auto;
    width:100%;
    height:550px;
    padding: 5px;
  }
  table{
    border: 1px solid #000;
  }
  .rotate {
    transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg); /* Safari/Chrome */
    -moz-transform: rotate(-90deg); /* Firefox */
    -o-transform: rotate(-90deg); /* Opera */
    -ms-transform: rotate(-90deg); /* IE 9 */
    width: auto;
  }
  th.verticalTD{
    width:40px;
    height: auto;
    line-height: 14px;
    padding-bottom: 0px;
    padding-left: 5px;
    padding-right: 5px;
    text-align: center;
  }
  div.vertical
  {
     margin-left: -85px;
     margin-right: -85px;
     width: auto;
     transform: rotate(-90deg);
     -webkit-transform: rotate(-90deg); /* Safari/Chrome */
     -moz-transform: rotate(-90deg); /* Firefox */
     -o-transform: rotate(-90deg); /* Opera */
     -ms-transform: rotate(-90deg); /* IE 9 */
     white-space: nowrap;
  }

  th.vertical
  {
   height: 90px;
   line-height: 14px;
   padding-bottom: 0px;
   text-align: center;
  }
  th{
      font-weight: normal;
  }


/* .columnFreeze{
  position: -webkit-sticky;
  position: sticky;
  left: 0;
  padding-left: 20px;
  top:0;
  z-index: 4;
  background-color: grey;
  color: black;
} */

  </style>

<script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
<link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " />

    <script type="text/javascript">
    $(function() {
            $('#myTable').stickyTable({overflowy: true});
          });
    </script>

  @php
    $companies = \App\Http\Controllers\companyController::getCompany();
    $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
  @endphp

  {{-- <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүдийн гүйцэтгэлийн тайлан</strong></h2> --}}
  <div class="table-div">
    <table border="1" class=" text-center" id="myTable">
      <thead >
        <tr class="naalt">
          <th rowspan="3" class="">Мэдээ</th>
          <th colspan="2" class="text-center " >Ажил гүйцэтгэгч Зэвсэгт хүчний анги, нэгтгэл, аж ахуйн нэгж байгууллага</th>
          @foreach ($companies as $company)
            <th colspan="8" class="text-center">{{$company->companyName}}</th>
          @endforeach
    		</tr>
        <tr class="naalt text-center">
          <th colspan="2" class="text-center columnFreeze">Хариуцах ПК-ийн байршил</th>
          @foreach ($companies as $company)
            <th colspan="8" class="text-center">{{$company->ajliinHeseg}}</th>
          @endforeach
    		</tr>
        <tr class="naalt ">
          <th class="text-center columnFreeze" >Мэдээний үзүүлэлт</th>
          <th class='text-center vertical columnFreeze' ><div class="rotate" >Хэмжих нэгж</div></th>
          @foreach ($companies as $company)
            <th class='text-center verticalTD' ><div class="rotate">Батлагдсан тоо хэмжээ</div></th>
            <th class='text-center verticalTD' ><div class="rotate">2019 оны гүйцэтгэл /хувь/</div></th>
            <th class='text-center verticalTD' ><div class="rotate">2020 онд гүйцэтгэх тоо хэмжээ</div></th>
            <th class='text-center verticalTD' ><div class="rotate">Өмнөх тайлангийн бүгд</div></th>
            <th class='text-center verticalTD' ><div class="rotate">Тайлант үеийн гүйцэтгэл</div></th>
            <th class='text-center verticalTD' ><div class="rotate">2020 оны бүгд гүйцэтгэл</div></th>
            <th class='text-center verticalTD' ><div class="rotate">2020 оны бүгд гүйцэтгэл /хувь/</div></th>
            <th class='text-center verticalTD' ><div class="rotate">Нийт гүйцэтгэлийн хувь</div></th>
          @endforeach
    		</tr>
      </thead>
    	<tbody>
        @foreach ($workTypes as $workType)
            @php
                $works = \App\Http\Controllers\WorkController::getCompactWorks($workType->id);
            @endphp
            <tr class="naalt">
              <th rowspan="{{$works->count()+1}}" class='vertical'> <div class="vertical">{{$workType->name}}</div> </th>
              <th class="text-nowrap text-left" style="padding-left:5px;">{{$works[0]->name}}</th>
              <th class="text-center">{{$works[0]->hemjih_negj}}</th>
              @foreach ($companies as $company)
                @php
                  $planAndExecutions = \App\Http\Controllers\ExecutionContoller::getExecutionAllCompanyIDworkID($company->id, $works[0]->id);
                  $planQuantity = 0;
                  $percent2019 = 0;
                  $totalExec2019 = 0;
                  $totalExecAll = 0;
                  $lastExec = 0;
                  $lastexec2020 = 0;
                  $totalPercent = 0;
                  foreach ($planAndExecutions as $planAndExecution) {
                      $planQuantity = $planAndExecution->planQuantity;
                      $percent2019 = $planAndExecution->percent2019;
                      $totalExec2019 = $planAndExecution->totalExec2019;
                      $totalExecAll = $planAndExecution->totalExecAll;
                      $lastExec = $planAndExecution->lastExec;
                      $lastexec2020 = $planAndExecution->lastexec2020;
                      $totalPercent = $planAndExecution->totalPercent;
                  }
                  // $planQuantity = \App\Http\Controllers\planController::getPlanByWorkID($company->id, $works[0]->id);
                  // $executionPercent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByWorkID2019($company->id, $works[0]->id);
                  // $execution2019 = \App\Http\Controllers\ExecutionContoller::getExecution2019($company->id, $works[0]->id);
                @endphp
                <td>{{$planQuantity}}</td>
                <td>{{round($percent2019, 2)}}</td>
                <td>{{round($planQuantity-$totalExec2019, 2)}}</td>
                <td>{{round($totalExecAll - $lastExec, 2)}}</td>
                <td>{{round($lastExec, 2)}}</td>
                <td>{{round($lastexec2020, 2)}}</td>
                @if(($planQuantity*(1-$percent2019*0.01)) == 0)
                  <td>0</td>
                  <td>0</td>
                @else
                  <td>{{round($lastexec2020*100/$planQuantity, 2)}}</td>
                  <td>{{round($lastexec2020*100/$planQuantity + $percent2019, 2)}}</td>
                @endif
              @endforeach
            </tr>
            @for ($i=1; $i < $works->count(); $i++)
              <tr>
                <th class="text-left" style="padding-left:5px;">{{$works[$i]->name}}</th>
                <th class="text-center">{{$works[$i]->hemjih_negj}}</th>
                @foreach ($companies as $company)
                  @php
                    $planAndExecutions = \App\Http\Controllers\ExecutionContoller::getExecutionAllCompanyIDworkID($company->id, $works[$i]->id);
                    $planQuantity = 0;
                    $percent2019 = 0;
                    $totalExec2019 = 0;
                    $totalExecAll = 0;
                    $lastExec = 0;
                    $lastexec2020 = 0;
                    $totalPercent = 0;
                    foreach ($planAndExecutions as $planAndExecution) {
                        $planQuantity = $planAndExecution->planQuantity;
                        $percent2019 = $planAndExecution->percent2019;
                        $totalExec2019 = $planAndExecution->totalExec2019;
                        $totalExecAll = $planAndExecution->totalExecAll;
                        $lastExec = $planAndExecution->lastExec;
                        $lastexec2020 = $planAndExecution->lastexec2020;
                        $totalPercent = $planAndExecution->totalPercent;
                    }
                    // $planQuantity = \App\Http\Controllers\planController::getPlanByWorkID($company->id, $works[$i]->id);
                    // $executionPercent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionPercentByWorkID2019($company->id, $works[$i]->id);
                    // $execution2019 = \App\Http\Controllers\ExecutionContoller::getExecution2019($company->id, $works[$i]->id);
                  @endphp
                  <td>{{$planQuantity}}</td>
                  <td>{{round($percent2019, 2)}}</td>
                  <td>{{round($planQuantity-$totalExec2019, 2)}}</td>
                  <td>{{round($totalExecAll - $lastExec, 2)}}</td>
                  <td>{{round($lastExec, 2)}}</td>
                  <td>{{round($lastexec2020, 2)}}</td>
                  @if(($planQuantity*(1-$percent2019*0.01)) == 0)
                    <td>0</td>
                    <td>0</td>
                  @else
                    <td>{{round($lastexec2020*100/$planQuantity, 2)}}</td>
                    <td>{{round($lastexec2020*100/$planQuantity + $percent2019, 2)}}</td>
                  @endif
                @endforeach
              </tr>
            @endfor
            <tr>
              <th>Нийт</th>
              <th></th>
              @foreach ($companies as $company)
                @php
                  $sumPlanAndExecs = \App\Http\Controllers\ExecutionContoller::getSumAndAvgExecPlan($company->id, $workType->id);

                  $sumPlanQuantity = 0;
                  $totalSumExec2019 = 0;
                  $totalSumExec = 0;
                  $lastSumExect = 0;
                  $sumExec2020 = 0;
                  foreach ($sumPlanAndExecs as $sumPlanAndExec) {
                      $sumPlanQuantity = $sumPlanAndExec->sumPlanQuantity;
                      $totalSumExec2019 = $sumPlanAndExec->totalSumExec2019;
                      $totalSumExec = $sumPlanAndExec->totalSumExec;
                      $lastSumExect = $sumPlanAndExec->lastSumExect;
                      $sumExec2020 = $sumPlanAndExec->sumExec2020;
                  }


                  // $sumPlanQuantity = \App\Http\Controllers\planController::getSumPlanQuantity($company->id, $workType->id);
                  $AvgExecutionPercent2019 = \App\Http\Controllers\ExecutionContoller::getExecutionWorkTypePercentAvg2019($company->id, $workType->id);

                  if($AvgExecutionPercent2019 == 0){
                    $totalExec2020 = $sumPlanQuantity;
                  }
                  else{
                    $totalExec2020 = $sumPlanQuantity - ($sumPlanQuantity * $AvgExecutionPercent2019/100);
                  }
              @endphp
                <td>{{round($sumPlanQuantity, 2)}}</td>
                @if($sumPlanQuantity>0)
                  <td>{{round($totalSumExec2019*100/$sumPlanQuantity, 2)}}</td>
                @else
                  <td>0</td>
                @endif
                <td>{{round($sumPlanQuantity - $totalSumExec2019, 2)}}</td>
                <td>{{round($totalSumExec-$lastSumExect,2)}}</td>
                <td>{{round($lastSumExect, 2)}}</td>
                <td>{{round($sumExec2020, 2)}}</td>
                @if($sumExec2020 == 0)
                  <td>0</td>
                @else
                  <td>{{round($sumExec2020*100/$sumPlanQuantity, 2)}}</td>
                @endif
                @if($sumPlanQuantity == 0)
                  <td>0</td>
                @else
                  <td>{{round($totalSumExec2019*100/$sumPlanQuantity+$sumExec2020*100/$sumPlanQuantity, 2)}}</td>
                @endif
              @endforeach
            </tr>
        @endforeach
    	</tbody>
    </table>
  </div>


@endsection
