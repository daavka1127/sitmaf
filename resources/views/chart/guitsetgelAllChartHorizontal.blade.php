@extends('layouts.layout_main')
@section('content')
  <script>
    window.onload = function () {

    //Better to construct options first and then pass it as a parameter
    var options = {
    	animationEnabled: true,
    	title:{
    		text: "Sales of ACME based on Sales-Channels"
    	},
    	axisY: {
    		suffix: "%"
    	},
    	toolTip: {
    		shared: true,
    		reversed: true
    	},
    	legend: {
    		reversed: true,
    		verticalAlign: "center",
    		horizontalAlign: "right"
    	},
    	data: [
    	{
    		type: "stackedColumn100",
    		name: "WholeSale",
    		showInLegend: true,
    		yValueFormatString: "#,##0\"%\"",
    		dataPoints: [
    		{ label: "Q1", y: 44 },
    		{ label: "Q2", y: 88 },
    		{ label: "Q3", y: 65 },
    		{ label: "Q4", y: 69 }
    		]
    	},
    	{
    		type: "stackedColumn100",
    		name: "Retail",
    		showInLegend: true,
    		yValueFormatString: "#,##0\"%\"",
    		dataPoints: [
    		{ label: "Q1", y: 48 },
    		{ label: "Q2", y: 29 },
    		{ label: "Q3", y: 73 },
    		{ label: "Q4", y: 99 }
    		]
    	},
    	{
    		type: "stackedColumn100",
    		name: "Inside Sales",
    		showInLegend: true,
    		yValueFormatString: "#,##0\"%\"",
    		dataPoints: [
    		{ label: "Q1", y: 19 },
    		{ label: "Q2", y: 41 },
    		{ label: "Q3", y: 5 },
    		{ label: "Q4", y: 39 }
    		]
    	},
    	{
    		type: "stackedColumn100",
    		name: "Mail Order",
    		showInLegend: true,
    		yValueFormatString: "#,##0\"%\"",
    		dataPoints: [
    		{ label: "Q1", y: 20 },
    		{ label: "Q2", y: 100 },
    		{ label: "Q3", y: 7 },
    		{ label: "Q4", y: 43 }
    		]
    	}
    	]
    };

    $("#chartContainer").CanvasJSChart(options);
    }
  </script>
  <div id="chartContainer" style="height: 370px; max-width: 920px; margin: 0px auto;"></div>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
@endsection
