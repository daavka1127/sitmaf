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
    		type: "stackedColumn100",
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
    		type: "stackedColumn100",
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

    $("#chartContainer123").CanvasJSChart(options);
}
</script>
