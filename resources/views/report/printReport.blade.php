@extends('layouts.layout_main')

@section('content')

  <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " />


<style media="screen">



th {
    border-collapse:collapse;

    width:100px;
    /* height: auto; */
    line-height: 30px;
    /* padding-bottom: 0px;
    padding-left: 5px;
    padding-right: 5px; */
    text-align: center;
    font-weight: 2px;
}


.table-header-rotated th.row-header{
  width: auto;

}

.table-header-rotated td{
  width: 40px;
  border-top: 1px solid #dddddd;
  border-left: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
  vertical-align: middle;
  text-align: center;
}

.table-header-rotated th.rotate-45{
  height: 80px;
  width: 40px;
  min-width: 40px;
  max-width: 40px;
  position: relative;
  vertical-align: bottom;
  padding: 0;
  font-size: 12px;
  line-height: 0.8;
}

.table-header-rotated th.rotate-45 > div{
  position: relative;
  top: 0px;
  left: 40px; /* 80 * tan(45) / 2 = 40 where 80 is the height on the cell and 45 is the transform angle*/
  height: 100%;
  -ms-transform:skew(-45deg,0deg);
  -moz-transform:skew(-45deg,0deg);
  -webkit-transform:skew(-45deg,0deg);
  -o-transform:skew(-45deg,0deg);
  transform:skew(-45deg,0deg);
  overflow: hidden;
  border-left: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
  border-top: 1px solid #dddddd;
}

.table-header-rotated th.rotate-45 span {
  -ms-transform:skew(45deg,0deg) rotate(315deg);
  -moz-transform:skew(45deg,0deg) rotate(315deg);
  -webkit-transform:skew(45deg,0deg) rotate(315deg);
  -o-transform:skew(45deg,0deg) rotate(315deg);
  transform:skew(45deg,0deg) rotate(315deg);
  position: absolute;
  bottom: 30px; /* 40 cos(45) = 28 with an additional 2px margin*/
  left: -25px; /*Because it looked good, but there is probably a mathematical link here as well*/
  display: inline-block;
  // width: 100%;
  width: 85px; /* 80 / cos(45) - 40 cos (45) = 85 where 80 is the height of the cell, 40 the width of the cell and 45 the transform angle*/
  text-align: left;
  // white-space: nowrap; /*whether to display in one line or not*/
}
</style>


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
    <table  class="table table-striped table-header-rotated">
      <thead>
        <tr>
          <th rowspan="2">Мэдээ агуулга</th>
          <th colspan="{{$companies->count()}}">Ажил гүйцэтгэх Зэвсэгт хүчний анги, туслан гүйцэтгэгч аж ахуйн нэгж байгууллага</th>
        </tr>
        <tr>
          @foreach ($companies as $company)
            <th class="rotate-45"><div><span>{{$company->companyName}}</span></div></th>
            {{-- <th class="rotate">{{$company->companyName}}</th> --}}
          @endforeach
        </tr>
      </thead>
    </table>
    <div>
  @endforeach

@endsection
