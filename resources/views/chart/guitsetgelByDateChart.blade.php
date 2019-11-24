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
            <option value="{{$company->id}}">{{$company->companyName}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="clearfix"></div>
<script>
window.onload = function () {
  var options = {
  	animationEnabled: true,
  	theme: "light2",
  	title:{
  		text: "АЖЛЫН ГҮЙЦЭТГЭЛТ"
  	},
  	axisX:{
  		valueFormatString: "DD MMM"
  	},
  	axisY: {
  		title: "Ажлын тоо хэмжээ /м.куб/",
  		suffix: "Мян",
  		minimum: 3
  	},
  	toolTip:{
  		shared:true
  	},
  	legend:{
  		cursor:"pointer",
  		verticalAlign: "bottom",
  		horizontalAlign: "left",
  		dockInsidePlotArea: true,
  		itemclick: toogleDataSeries
  	},



  	data: [{
        type: "line",
        showInLegend: true,
        name: "Хөрс хуулалт",
        markerType: "square",
        xValueFormatString: "DD MMM, YYYY",
        color: "#F08080",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gHursHuulalt}}},
          @endforeach
        ]
      },
      {
        type: "line",
        showInLegend: true,
        name: "Далан",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gDalan}}},
          @endforeach
        ]
      }
  	]
  };
  $("#chartContainer").CanvasJSChart(options);

  function toogleDataSeries(e){
  	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
  		e.dataSeries.visible = false;
  	} else{
  		e.dataSeries.visible = true;
  	}
  	e.chart.render();
  }
}
</script>

<div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
@endsection
