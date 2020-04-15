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
                        @foreach ($hesegCompanies as $company)
                            '{!!$company->companyName!!}',
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
                        @foreach ($hesegCompanies as $company)
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
        $("#cmbHeseg").change(function(){
          $(".divWorkType").css("display","none");
          if($("#cmbHeseg").val() > 0)
            window.location.href = "{{url('/chart/all')}}/" + $("#cmbHeseg").val();
        });

          $("#cmbCompany").change(function(){
            $(".divWorkType").css("display","block");

          });
          $("#cmbWorkType").change(function(){
            // $(".divWorkType").css("display","block");
              window.location.href = "{{url('/chart/byDate')}}/" + {{Auth::user()->heseg_id}} + "/" + $("#cmbCompany").val() + "/" + $("#cmbWorkType").val();
          });

      });


    </script>

    <div class="col-md-4">
      <label>Хэсгээр харах</label>
      <select class="form-control" id="cmbHeseg">
        <option value="0">Сонгоно уу</option>
        @foreach ($hesegs as $heseg)
            @if($heseg->id == $hesegID)
              <option value="{{$heseg->id}}" selected>{{$heseg->name}}</option>
            @else
              <option value="{{$heseg->id}}">{{$heseg->name}}</option>
            @endif
        @endforeach
        @if(Auth::user()->heseg_id > 3)
        <option value="4">Бүх хэсгээр харах</option>
      @endif
      </select>

    </div>
    <div class="col-md-2">

    </div>
    <div class="col-md-5">
      <div class="row">
        <label>Аж ахуйн нэгжээр харах</label>
        <select class="form-control" id="cmbCompany">
          <option value="0">Сонгоно уу</option>
          @foreach ($companiesChart as $company)
              <option value="{{$company->id}}">{{$company->companyName}}-><strong>{{$company->ajliinHeseg}}</strong></option>
          @endforeach
        </select>
      </div>
      <div class="divWorkType row" style="display:none;">
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

  </div>
  <br>
  <div class="row">
    <div class="col-md-4">
      @php
        $getDate = App\Http\Controllers\guitsetgelChartController::getLastGenrateDate();
        foreach ($getDate as $date) {
        $dd =  $date->endDate;
        }
        // $dd = explode("&", $getDate);
        echo "<p>".$dd." өдрийн байдлаар</p>";
      @endphp
    </div>
  </div>
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
      <div id="jqChart" style="height: 650px;" class="col-md-12"></div>
  </div>
<div class="clearfix"></div>
<br>
  <div id="chartContainer" style="height: 400px; max-width: 4050px; margin: 0px auto;"></div>
@endsection
