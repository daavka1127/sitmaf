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
  /* tr th {
    top:0;
    position: sticky;
  } */
  .rotate {
    /* FF3.5+ */
    transform: rotate(-90deg);
    -webkit-transform: rotate(-90deg); /* Safari/Chrome */
    -moz-transform: rotate(-90deg); /* Firefox */
    -o-transform: rotate(-90deg); /* Opera */
    -ms-transform: rotate(-90deg); /* IE 9 */
    width: auto;
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
 height: 150px;
 line-height: 14px;
 padding-bottom: 20px;
 text-align: left;

}
th.verticalTD{
  width:40px;
  height: 100px;
  line-height: 14px;
  padding-bottom: 0px;
  padding-left: 10px;
  padding-right: 10px;
  text-align: center;

}
th{
    font-weight: normal;
}
  </style>

  @php
    $companies = \App\Http\Controllers\companyController::getCompany();
    $workTypes = \App\Http\Controllers\WorktypeController::getCompactWorkType();
  @endphp

  <h2 style="text-align:center;"><strong>Аж ахуйн нэгжүүдийн гүйцэтгэлийн тайлан</strong></h2>
  <div class="table-div">
    <table border="1" class="text-center">
      <thead>
        <tr class="naalt">
          <th rowspan="3" class='rotate'>Мэдээ</th>
          <th colspan="2" class="text-center">Ажил гүйцэтгэгч Зэвсэгт хүчний анги, нэгтгэл, аж ахуйн нэгж байгууллага</th>
          @foreach ($companies as $company)
            <th colspan="8" class="text-center">{{$company->companyName}}</th>
          @endforeach
    		</tr>
        <tr class="naalt text-center">
          <th colspan="2" class="text-center">Хариуцах ПК-ийн байршил</th>
          @foreach ($companies as $company)
            <th colspan="8" class="text-center">{{$company->ajliinHeseg}}</th>
          @endforeach
    		</tr>
        <tr class="naalt ">
          <th class="text-center">Мэдээний үзүүлэлт</th>
          <th class='text-center verticalTD'><div class="rotate">Хэмжих нэгж</div></th>
          @foreach ($companies as $company)
            <th class='text-center verticalTD'><div class="rotate">Батлагдсан тоо <br>хэмжээ /м.куб/</div></th>
            <th class='text-center verticalTD'><div class="rotate">2019 оны гүйцэтгэл /хувь/</div></th>
            <th class='text-center verticalTD'><div class="rotate">2020 онд гүйцэтгэх тоо хэмжээ /м.куб/</div></th>
            <th class='text-center verticalTD'><div class="rotate">Өмнөх тайлангийн бүгд</div></th>
            <th class='text-center verticalTD'><div class="rotate">Тайлант үеийн гүйцэтгэл</div></th>
            <th class='text-center verticalTD'><div class="rotate">2020 оны бүгд гүйцэтгэл /тоо/</div></th>
            <th class='text-center verticalTD'><div class="rotate">2020 оны бүгд гүйцэтгэл /хувь/</div></th>
            <th class='text-center verticalTD'><div class="rotate">Нийт гүйцэтгэлийн хувь</div></th>
          @endforeach
    		</tr>
      </thead>
    	<tbody>
        @foreach ($workTypes as $workType)
            @php
                $works = \App\Http\Controllers\WorkController::getCompactWorks($workType->id);
            @endphp
            <tr class="naalt">
              <td rowspan="{{$works->count()+1}}" class='vertical'> <div class="vertical">{{$workType->name}}</div> </td>
              <td class="text-nowrap text-left" style="padding-left:5px;">{{$works[0]->name}}</td>
              <td >{{$works[0]->hemjih_negj}}</td>
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
            @for ($i=1; $i < $works->count(); $i++)
              <tr>
                <td class="text-left" style="padding-left:5px;">{{$works[$i]->name}}</td>
                <td>{{$works[$i]->hemjih_negj}}</td>
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
