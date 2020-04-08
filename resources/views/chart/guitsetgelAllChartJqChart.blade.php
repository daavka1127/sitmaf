@extends('layouts.layout_main')
@section('content')
  <link rel="stylesheet" type="text/css" href="{{url('public/jqChart/jqstyles.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{url('public/jqChart/jquery.jqChart.css')}}" />
	<script src="{{url('public/jqChart/jquery.jqChart.min.js')}}" type="text/javascript"></script>
  <script lang="javascript" type="text/javascript">
      $(document).ready(function () {
          $('#jqChart').jqChart({
              title: { text: 'Аж ахуйн нэгжийн гүйцэтгэлийн хувь' },
              animation: {
                  duration: 1
              },
              axes: [
                  {
                      type: 'category',
                      location: 'bottom',

                      categories: [
                        @foreach ($companiesChart as $company)
                            '{{$company->companyName}}',
                        @endforeach
                        ],
                      labels: {
                          font: '12px sans-serif',
                          angle: -90
                      }
                  }
              ],
              series: [
                  {
										title: 'Гүйцэтгэлийн хувь',
                      type: 'column',
                      data: [
                        @foreach ($companiesChart as $company)
                        @php
                          $dundaj = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);
                        @endphp
                            {{round($dundaj, 2)}},
                        @endforeach

                      ]
                  }
              ]
          });
      });
  </script>
  <div class="clearfix"></div>
  <div class="row">
    <script>
      $(document).ready(function(){
          $("#cmbCompany").change(function(){
            $(".divWorkType").css("display","block");
            $("#cmbWorkType").val("0");
          });

          $("#cmbWorkType").change(function(){
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
        @if($hesegID == 1)
            <option value="1" selected>Зүүнбаян чиглэл I хэсэг</option>
        @else
            <option value="1">Зүүнбаян чиглэл I хэсэг</option>
        @endif
        @if($hesegID == 2)
            <option value="2" selected>Мандах чиглэл II хэсэг</option>
        @else
            <option value="2">Мандах чиглэл II хэсэг</option>
        @endif
        @if($hesegID == 3)
            <option value="3" selected>Цогтцэций чиглэл III чиглэл</option>
        @else
            <option value="3">Цогтцэций чиглэл III чиглэл</option>
        @endif
        @if($hesegID == 4)
            <option value="4" selected>Бүх аж ахуйн нэгжээр</option>
        @else
            <option value="4">Бүх аж ахуйн нэгжээр</option>
        @endif
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
    <div class="divWorkType col-md-4" style="display:none;">
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
  <br>
  <div class="clearfix"></div>
  <script>
  window.onload = function () {

  //Better to construct options first and then pass it as a parameter
  var options = {
  	animationEnabled: true,
  	theme: "light2", //"light1", "dark1", "dark2"
  	title:{
  		text: "Нийт гүйцэтгэлийн график үзүүлэлт"
  	},
  	axisY:{
  		interval: 10,
  		suffix: "%"
  	},
  	toolTip:{
  		shared: true
  	},
  	data:[{
  		type: "stackedBar100",
  		toolTipContent: "{label}<br><b>{name}:</b> {y} (#percent%)",
  		showInLegend: true,
  		name: "Гүйцэтгэлт",
      @php
        $huvi = App\Http\Controllers\GuitsetgelController::generalChart(4);
        $huvi1 = App\Http\Controllers\GuitsetgelController::generalChart(1);
        $huvi2 = App\Http\Controllers\GuitsetgelController::generalChart(2);
        $huvi3 = App\Http\Controllers\GuitsetgelController::generalChart(3);
      @endphp
  		dataPoints: [
  			{ y: {{$huvi}}, label: "Нийт" },
        { y: {{$huvi1}}, label: "Зүүнбаян чиглэл I хэсэг" },
        { y: {{$huvi2}}, label: "Мандах чиглэл II хэсэг" },
        { y: {{$huvi3}}, label: "Цогтцэций чиглэл III чиглэл" },
  		]
  	},
  	{
  		type: "stackedBar100",
  		toolTipContent: "<b>{name}:</b> {y} (#percent%)",
  		showInLegend: true,
  		name: "Үлдсэн",
  		dataPoints: [
        { y: {{100 - $huvi}}, label: "Нийт" },
        { y: {{100 - $huvi1}}, label: "Зүүнбаян чиглэл I хэсэг" },
        { y: {{100 - $huvi2}}, label: "Мандах чиглэл II хэсэг" },
        { y: {{100 - $huvi3}}, label: "Цогтцэций чиглэл III чиглэл" },
  		]
  	}]
  };

  $("#chartContainer").CanvasJSChart(options);
  }
  </script>
  <div class="clearfix"></div>
  <br>
  <div>
      <div id="jqChart" style="height: 500px;" class="col-md-12"></div>
  </div>
<div class="clearfix"></div>
<br>
  <div id="chartContainer" style="height: 400px; max-width: 4050px; margin: 0px auto;"></div>
@endsection
