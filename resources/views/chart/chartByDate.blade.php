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
          @if($data->gHursHuulalt != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gHursHuulalt}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
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
          @if($data->gDalan != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gDalan}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
          @endforeach
        ]
      },

      {
        type: "line",
        showInLegend: true,
        name: "Ухмал",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          @if($data->gUhmal != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gUhmal}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
          @endforeach
        ]
      },
      {
        type: "line",
        showInLegend: true,
        name: "Суурийн үе",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          @if($data->gSuuriinUy != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gSuuriinUy}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
          @endforeach
        ]
      },
      {
        type: "line",
        showInLegend: true,
        name: "Шуудуу",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          @if($data->gShuuduu != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gShuuduu}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
          @endforeach
        ]
      },
      {
        type: "line",
        showInLegend: true,
        name: "Ухмалын хамгаалалт",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          @if($data->gUhmaliinHamgaalalt != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gUhmaliinHamgaalalt}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
          @endforeach
        ]
      },
      {
        type: "line",
        showInLegend: true,
        name: "Уулын шуудуу",
        markerType: "square",
        yValueFormatString: "#,##0 мян",
        dataPoints: [
          @foreach ($datas as $data)
          @php
            $date = explode("-",$data->ognoo);
          @endphp
          @if($data->gUuliinShuuduu != null)
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: {{$data->gUuliinShuuduu}}},
          @else
          { x: new Date({{$date[0]}}, {{$date[1]}}, {{$date[2]}}), y: 0},
          @endif
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
