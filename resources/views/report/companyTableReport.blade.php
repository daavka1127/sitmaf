@extends('layouts.layout_main')

@section('content')
  <script>


  </script>

  <style>
  .table-div{
    overflow:auto;
    width:100%;
    height:500px;
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

  <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүдийн гүйцэтгэлийн тайлан</strong></h2>
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
                  $planQuantity = \App\Http\Controllers\planController::getPlanByWorkID($company->id, $works[0]->id);
                @endphp
                <td>{{$planQuantity}}</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
              @endforeach
            </tr>
            @for ($i=1; $i < $works->count(); $i++)
              <tr>
                <th class="text-left" style="padding-left:5px;">{{$works[$i]->name}}</th>
                <th class="text-center">{{$works[$i]->hemjih_negj}}</th>
                @foreach ($companies as $company)
                  @php
                    $planQuantity = \App\Http\Controllers\planController::getPlanByWorkID($company->id, $works[$i]->id);
                  @endphp
                  <td>{{$planQuantity}}</td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <td>7</td>
                  <td>8</td>
                @endforeach
              </tr>
            @endfor
            <tr>
              <th>Нийт</th>
              <th></th>
              @foreach ($companies as $company)
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
              @endforeach
            </tr>
        @endforeach
    	</tbody>
    </table>
  </div>


@endsection
