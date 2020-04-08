<script>
window.onload = function () {

    //Better to construct options first and then pass it as a parameter
    var options1 = {
    	animationEnabled: true,
    	theme: "light1", //"light1", "dark1", "dark2"
    	title:{
    		text: ""
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
          @php
            $plans = App\Http\Controllers\GuitsetgelController::getPlans($companyID, $workTypeID);

          @endphp


          @php
            foreach ($plans as $plan) {
              $exec = App\Http\Controllers\GuitsetgelController::getSumWorkExecution($companyID, $plan->work_id);
              if($exec != "")
                echo "{ y: 100 * $exec->execution/$plan->quantity, label: \"$plan->workName\" },";
              else
                echo "{ y: 0, label: \"$plan->workName\" },";
            }
          @endphp


    	]
    	},
    	{
    		type: "stackedColumn100",
    		toolTipContent: "<b>{name}:</b> {y} (#percent%)",
    		showInLegend: true,
    		name: "Үлдсэн ажил",
    		dataPoints: [
          @php
            foreach ($plans as $plan) {
              $exec = App\Http\Controllers\GuitsetgelController::getSumWorkExecution($companyID, $plan->work_id);
              if($exec != "")
                if(100 * $exec->execution/$plan->quantity > 100)
                  echo "{ y: 83, label: \"$plan->workName\" },";
                else {
                  echo "{ y: 100- 100*$exec->execution/$plan->quantity, label: \"$plan->workName\" },";
                }
              else
                echo "{ y: 100, label: \"$plan->workName\" },";

            }
          @endphp

    		]
    	}

    ]
    };

    $("#chartContainer123").CanvasJSChart(options1);
}
</script>
