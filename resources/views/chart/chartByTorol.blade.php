<div>{{$guitsetgel->hursHuulalt}}</div>
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

            @if($guitsetgel->hursHuulalt != null || $guitsetgel->hursHuulalt != 0)
            { y: {{ 100*$guitsetgel->gHursHuulalt/$guitsetgel->hursHuulalt }}, label: "Хөрс хуулалт" },
            @endif
            @if($guitsetgel->dalan != null || $guitsetgel->dalan != 0)
            { y: {{ 100*$guitsetgel->gDalan/$guitsetgel->dalan }}, label: "Далан" },
            @endif
            @if($guitsetgel->uhmal != null || $guitsetgel->uhmal != 0)
            { y: {{ 100*$guitsetgel->gUhmal/$guitsetgel->uhmal }}, label: "Ухмал" },
            @endif
            @if($guitsetgel->suuriinUy != null || $guitsetgel->suuriinUy != 0)
            { y: {{ 100*$guitsetgel->gSuuriinUy/$guitsetgel->suuriinUy }}, label: "Суурийн үе" },
            @endif
            @if($guitsetgel->shuuduu != null || $guitsetgel->shuuduu != 0)
            { y: {{ 100*$guitsetgel->gShuuduu/$guitsetgel->shuuduu }}, label: "Шуудуу" },
            @endif
            @if($guitsetgel->uhmaliinHamgaalalt != null || $guitsetgel->uhmaliinHamgaalalt != 0)
            { y: {{ 100*$guitsetgel->gUhmaliinHamgaalalt/$guitsetgel->uhmaliinHamgaalalt }}, label: "Ухмалын хамгаалалт" },
            @endif
            @if($guitsetgel->uuliinShuuduu != null || $guitsetgel->uuliinShuuduu != 0)
            { y: {{ 100*$guitsetgel->gUuliinShuuduu/$guitsetgel->uuliinShuuduu }}, label: "Уулын шуудуу" }
            @endif

    		]
    	},
    	{
    		type: "stackedColumn100",
    		toolTipContent: "<b>{name}:</b> {y} (#percent%)",
    		showInLegend: true,
    		name: "Үлдсэн ажил",
    		dataPoints: [

          @if($guitsetgel->hursHuulalt != null || $guitsetgel->hursHuulalt != 0)
          { y: {{ 100-100*$guitsetgel->gHursHuulalt/$guitsetgel->hursHuulalt }}, label: "Хөрс хуулалт" },
          @endif
          @if($guitsetgel->dalan != null || $guitsetgel->dalan != 0)
          { y: {{ 100-100*$guitsetgel->gDalan/$guitsetgel->dalan }}, label: "Далан" },
          @endif
          @if($guitsetgel->uhmal != null || $guitsetgel->uhmal != 0)
          { y: {{ 100-100*$guitsetgel->gUhmal/$guitsetgel->uhmal }}, label: "Ухмал" },
          @endif
          @if($guitsetgel->suuriinUy != null || $guitsetgel->suuriinUy != 0)
          { y: {{ 100-100*$guitsetgel->gSuuriinUy/$guitsetgel->suuriinUy }}, label: "Суурийн үе" },
          @endif
          @if($guitsetgel->shuuduu != null || $guitsetgel->shuuduu != 0)
          { y: {{ 100-100*$guitsetgel->gShuuduu/$guitsetgel->shuuduu }}, label: "Шуудуу" },
          @endif
          @if($guitsetgel->uhmaliinHamgaalalt != null || $guitsetgel->uhmaliinHamgaalalt != 0)
          { y: {{ 100-100*$guitsetgel->gUhmaliinHamgaalalt/$guitsetgel->uhmaliinHamgaalalt }}, label: "Ухмалын хамгаалалт" },
          @endif
          @if($guitsetgel->uuliinShuuduu != null || $guitsetgel->uuliinShuuduu != 0)
          { y: {{ 100-100*$guitsetgel->gUuliinShuuduu/$guitsetgel->uuliinShuuduu }}, label: "Уулын шуудуу" }
          @endif

    		]
    	}]
    };

    $("#chartContainer123").CanvasJSChart(options1);
}
</script>
