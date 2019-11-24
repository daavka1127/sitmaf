@extends('layouts.layout_main')
@section('content')
  <div class="clearfix"></div>
  <div class="row">
    <script>
      $(document).ready(function(){
          $("#cmbCompany").change(function(){
              window.location.href = "{{url('/chart/byDate')}}/" + $("#cmbCompany").val();
          });
      });
    </script>
    <script>
      $(document).ready(function(){
          $("#cmbHeseg").change(function(){
              window.location.href = "{{url('/chart/all')}}";
          });
      });
    </script>
    <div class="col-md-4">
      <label>Аж ахуйн нэгж</label>
      <select class="form-control" id="cmbHeseg">
        <option value="0">Сонгоно уу</option>
        <option value="1">Зүүнбаян чиглэл I хэсэг</option>
        <option value="2">Мандах чиглэл II хэсэг</option>
        <option value="3">Цогтцэций чиглэл III чиглэл</option>
        <option value="4">Бүх аж ахуйн нэгжээр</option>
      </select>
    </div>
    <div class="col-md-4">
      <label>Аж ахуйн нэгж</label>
      <select class="form-control" id="cmbCompany">
        <option value="0">Сонгоно уу</option>
        @foreach ($companies as $company)
          @if($companyID == $company->id)
            <option value="{{$company->id}}" selected>{{$company->companyName}}</option>
          @else
            <option value="{{$company->id}}">{{$company->companyName}}</option>
          @endif
        @endforeach
      </select>
    </div>
  </div>
  <link href="{{url('public/jqChart/jqstyles.css')}}" rel="stylesheet">
  <link href="{{url('public/jqChart/jquery.jqChart.css')}}" rel="stylesheet">
  <script src="{{url('public/jqChart/jquery.jqChart.min.js')}}"></script>
  <div class="clearfix"></div>
  <br>
  @include('chart.chartByDate')
<div class="clearfix"></div>
@include('chart.chartByTorol')
<div id="jqChart" style="height: 370px; max-width: 920px; margin: 0px auto; background-color: #fff"></div>
<div class="clearfix"></div>
<br>
<div style="color: black; font-size: 20px; font-weight: bold" class="col-md-12 col-md-offset-5">Гүйцэтгэл /үзүүлэлтээр/</div>
<div class="clearfix"></div>

<div id="chartContainer123" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
@endsection
