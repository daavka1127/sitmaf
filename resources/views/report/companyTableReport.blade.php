@extends('layouts.layout_main')

@section('content')
  <script>


  </script>
    <style type="text/css">
        @media print
        {
        body * { visibility: hidden; }
        .table-div * { visibility: visible; }
        .table-div { position: absolute; top: 40px; left: 30px; }
        }
    </style>
  <style>
  .table-div{
    overflow:auto;
    width:100%;
    height:500px;
    padding: 5px;
  }
  tr th {
    top:0;
    position: sticky;
  }
  </style>
  @php
    $companies = \App\Http\Controllers\companyController::getCompany();
    $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
  @endphp
  <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүдийн гүйцэтгэлийн тайлан</strong></h2>
  <div class="table-div">
    <table border="1">
      <thead>
        <tr class="naalt">
          <th rowspan="3">Мэдээ</th>
          <th colspan="2">Ажил гүйцэтгэгч Зэвсэгт хүчний анги, нэгтгэл, аж ахуйн нэгж байгууллага</th>
          @foreach ($companies as $company)
            <th colspan="8">{{$company->companyName}}</th>
          @endforeach
    		</tr>
        <tr class="naalt">
          <th colspan="2">Хариуцах ПК-ийн байршил</th>
          @foreach ($companies as $company)
            <th colspan="8">{{$company->ajliinHeseg}}</th>
          @endforeach
    		</tr>
        <tr class="naalt">
          <th>Мэдээний үзүүлэлт</th>
          <th>Хэмжих нэгж</th>
          @foreach ($companies as $company)
            <th>Батлагдсан тоо хэмжээ /м.куб/</th>
            <th>2019 оны гүйцэтгэл /хувь/</th>
            <th>2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</th>
            <th>Өмнөх тайлангийн бүгд</th>
            <th>Тайлант үеийн гүйцэтгэл</th>
            <th>2020 оны бүгд гүйцэтгэл /тоо/</th>
            <th>2020 оны бүгд гүйцэтгэл /хувь/</th>
            <th>Нийт гүйцэтгэлийн хувь</th>
          @endforeach
    		</tr>
      </thead>
    	<tbody>
        @foreach ($workTypes as $workType)
            @php
                $works = \App\Http\Controllers\WorkController::getCompactWorks($workType->id);
            @endphp
            <tr>
              <td rowspan="{{$works->count()+1}}">{{$workType->name}}</td>
              <td>{{$works[0]->name}}</td>
              <td>{{$works[0]->hemjih_negj}}</td>
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
                <td>{{$works[$i]->name}}</td>
                <td>{{$works[$i]->hemjih_negj}}</td>
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
              <td>Нийт</td>
              <td></td>
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
