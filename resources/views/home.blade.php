@extends('layouts.layout_main')
@section('content')
  {{-- <link rel="stylesheet" href="{{url('public/autoCompleteCombo/autoStyle.css')}}">
	<link rel="stylesheet" href="{{url('public/autoCompleteCombo/base.jquery.css')}}">
	<style>
  	.custom-combobox {
  		position: relative;
  		display: inline-block;
  	}
  	.custom-combobox-toggle {
  		position: absolute;
  		top: 0;
  		bottom: 0;
  		margin-left: -1px;
  		padding: 0;
  	}
  	.custom-combobox-input {
  		margin: 0;
  		padding: 5px 10px;
  	}
	</style>
	<script src="{{url('public/autoCompleteCombo/autojquery.js')}}"></script>
	<script src="{{url('public/autoCompleteCombo/autojquery-ui.js')}}"></script>
	<script src="{{url('public/autoCompleteCombo/autoHeader.js')}}"></script> --}}

  <div class="clearfix"></div>
  <div class="row">
    <script>
      $(document).ready(function(){
          $("#combobox").change(function(){
            $(".divWorkType").css("display","block");
              window.location.href = "{{url('/chart/byDate')}}/" + $("#cmbCompany").val() + "/" + $("#cmbWorkType").val();
          });
      });
    </script>
    <script>
      $(document).ready(function(){
          $("#cmbHeseg").change(function(){
            $(".divWorkType").css("display","none");
              window.location.href = "{{url('/chart/all')}}/" + $("#cmbHeseg").val();
          });
      });
    </script>
    <div class="col-md-4">
      <label>Хэсгээр харах</label>
      <select class="form-control" id="cmbHeseg">
        <option value="0">Сонгоно уу</option>
        <option value="1">Зүүнбаян чиглэл I хэсэг</option>
        <option value="2">Мандах чиглэл II хэсэг</option>
        <option value="3">Цогтцэций чиглэл III чиглэл</option>
        <option value="4">Бүх аж ахуйн нэгжээр</option>
      </select>
    </div>

    <div class="col-md-4">
      <label>Аж ахуйн нэгжээр харах</label>
      <select class="form-control" id="cmbCompany">
        <option value="0">Сонгоно уу</option>
        @foreach ($companies as $company)
            <option value="{{$company->id}}">{{$company->companyName}}</option>
        @endforeach
      </select>
    </div>
    <div class="divWorkType col-md-4" style="display: none;">
      <label>Хийгдэж буй ажлын төрөл</label>
      <select class="form-control" id="cmbWorkType">
        <option value="0">Сонгоно уу</option>
        @php
          $workTypes = App\Http\Controllers\WorktypeController::getCompactWorkType();
        @endphp
        @foreach ($workTypes as $workType)
            <option value="{{$workType->id}}">{{$workType->name}}</option>
        @endforeach
      </select>
    </div>
  </div>

  <div style="display:none;" id="loading" class="col-md-2 col-md-offset-5">
    <br/>
    <div class="clearfix"></div>
    <img width="100" src="{{url('public/images/loading_big.gif')}}" />
  </div>
  <div id="chartContent">

  </div>
  {{-- <script type="text/javascript" src="{{url('public/js/guitsetgelChartAll/guitsetgelChartAll.js')}}"></script> --}}
@endsection
