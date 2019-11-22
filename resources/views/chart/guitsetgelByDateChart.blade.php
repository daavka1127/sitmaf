@extends('layouts.layout_main')
@section('content')
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
{{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> --}}
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endsection
