@extends('layouts.layout_main')

@section('content')

  <script src="{{url('/public/js/davkaFreeze/jquery-stickytable.js')}} "></script>
  <link rel="stylesheet" type="text/css" href=" {{url('/public/js/davkaFreeze/jquery-stickytable.css')}} " />


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

    <table border="1" class="">
      <thead>
        <tr>
          <th rowspan="2">Мэдээ агуулга</th>
          <th colspan="{{$companies->count()}}">Ажил гүйцэтгэх Зэвсэгт хүчний анги, туслан гүйцэтгэгч аж ахуйн нэгж байгууллага</th>
        </tr>
        <tr>
          @foreach ($companies as $company)
            <th class="verticalTD"><div class="rotate">{{$company->companyName}}</div></th>
            {{-- <th class="rotate">{{$company->companyName}}</th> --}}
          @endforeach
        </tr>
      </thead>
    </table>

  @endforeach

@endsection
