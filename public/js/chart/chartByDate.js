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

          $.each(datas, function(i, item)
          {
            var date = datas[i].ognoo.split("-");
            { x: new Date(date[0], date[1], date[2]), y: '1255' },
          }
        ]
      }
      // {
      //   type: "line",
      //   showInLegend: true,
      //   name: "Далан",
      //   markerType: "square",
      //   yValueFormatString: "#,##0 мян",
      //   dataPoints: [
      //     $.each(datas, function(i, item)
      //     {
      //       var date = split("-",datas[i].ognoo]);
      //       alert(date[0]);
      //       { x: new Date(date[0], date[1], date[2]), y: data['gHursHuulalt']},
      //     }
      //   ]
      // }
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
