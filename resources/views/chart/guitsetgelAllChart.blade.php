@extends('layouts.layout_main')
@section('content')
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-4">
      <label>Аж ахуйн нэгж</label>
      <select class="form-control">
        <option value="0">Сонгоно уу</option>
        
      </select>
    </div>
    <div class="col-md-4">
      <label>Аж ахуйн нэгж</label>
      <select class="form-control">
        <option value="0">Сонгоно уу</option>
        @foreach ($companies as $company)
            <option value="{{$company->id}}">{{$company->companyName}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="clearfix"></div>
<script>
window.onload = function () {

//Better to construct options first and then pass it as a parameter
var options = {
	animationEnabled: true,
	theme: "light1", //"light1", "dark1", "dark2"
	title:{
		text: "Аж ахуйн нэгжүүдийн гүйцэтгэл"
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
		name: "Гүйцэтгэл",
		dataPoints: [
      @foreach ($companies as $company)
        @php
          $dundaj = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);
        @endphp
        { y: {{ $dundaj}}, label: "{{$company->companyName}}" },
      @endforeach
		]
	},
	{
		type: "stackedBar100",
		toolTipContent: "<b>{name}:</b> {y} (#percent%)",
		showInLegend: true,
		name: "Үлдсэн ажил",
		dataPoints: [
      @foreach ($companies as $company)
        @php
          $dundaj = App\Http\Controllers\GuitsetgelController::getGuitsetgelHuvi($company->id);
        @endphp
        { y: {{100 - $dundaj}}, label: "{{$company->companyName}}" },
      @endforeach
		]
	}]
};

$("#chartContainer").CanvasJSChart(options);
}
</script>

<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endsection
