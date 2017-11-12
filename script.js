function clear(){
  $('#chartContainer').remove(); // this is my <canvas> element

  var next = document.getElementById("tekst");
  var div = document.createElement("div");
  div.id = "chartContainer";

  document.getElementById("main").insertBefore(div, next);
};

function srednie() {
    var table = document.getElementById('srednie');
    var array = new Array();
    var id = 0;
    for (var r = 0, n = table.rows.length; r < n; r++) {
        for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
            array[id] = table.rows[r].cells[c].innerHTML;
            console.log(array[id]);
            id++;
        }
    }
    console.log('ID: '+ id);

    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Wartości średnie i odchylenie standardowe"
      },
      data: [{
        type: "column",
        showInLegend: true,
        legendText: "wartość średnia",
        dataPoints: [
        { label: array[0], y: parseFloat(array[5]) },
        { label: array[1], y: parseFloat(array[6]) },
        { label: array[2], y: parseFloat(array[7]) },
        { label: array[3], y: parseFloat(array[8]) },
        { label: array[4], y: parseFloat(array[9]) }
        ]
      },
      {
        type: "column",
        showInLegend: true,
        legendText: "odchylenie standardowe",
        dataPoints: [
        { label: array[0], y: parseFloat(array[10]) },
        { label: array[1], y: parseFloat(array[11]) },
        { label: array[2], y: parseFloat(array[12]) },
        { label: array[3], y: parseFloat(array[13]) },
        { label: array[4], y: parseFloat(array[14]) }
        ]
      }
      ]
    });
    chart.render();
}

function poprawioneDane(){
    var table = document.getElementById('poprawione');
    var array1 = new Array();
    var array2 = new Array();
    var row_size = 5;
    var id = 0;
    for (var r = 1, n = table.rows.length-1; r < n; r++) {
      array1[id] = {y:  parseFloat(table.rows[r].cells[1].innerHTML)};
      array2[id] = {y:  parseFloat(table.rows[r].cells[2].innerHTML)};
      //console.log(array[id]);
      id++;
    }
    /*
    for(var i = 0; i<id; i++){
      console.log(array[i]);
    }*/
    //console.log('Cells Size: '+ table.rows[0].cells.length);
    var chart = new CanvasJS.Chart("chartContainer",
    {

      title:{
      text: "Dane - dawcy krwi"
      },
      axisY:{
        interval: 5
      },
       data: [
         {
          type: "line",
          showInLegend: true,
          legendText: "Frequency (times)",
          dataPoints: array1
        },{
          type: "line",
          showInLegend: true,
          legendText: "Monetary (l blood)",
          dataPoints: array2
        }
      ]
    });

    chart.render();
  }

function pearson(){
    var table = document.getElementById('pearson');
    var array = new Array();
    var row_size = 5;
    var id = 0;
    for (var r = 1, n = table.rows.length-1; r < n; r++) {
      array[id] = {x:  parseFloat(table.rows[r].cells[0].innerHTML), y:  parseFloat(table.rows[r].cells[1].innerHTML)};
      //console.log(array[id]);
      id++;
    }
    //console.log(array);
    //console.log('Cells Size: '+ table.rows[0].cells.length);
    var chart = new CanvasJS.Chart("chartContainer",
    {

      title:{
      text: "Korelacja Pearsona"
      },
       data: [
         {
          type: "scatter",
          color: "#778899",
          dataPoints: array
        }
      ]
    });

    chart.render();
  }

function regresjaLiniowa(){
    var a = 0.25;
    var b = 0;
    var array = new Array();
    for (var r = 0, n = 100; r < n; r++) {
      array[r] = {x: r, y: (r*0.25) };
    }
    /*
    for(var i = 0; i<100; i++){
      console.log(array[i]);
    }*/
    var chart = new CanvasJS.Chart("chartContainer",
    {

      title:{
      text: "Regresja liniowa"
      },
       data: [
         {
          type: "line",
          dataPoints: array
        }
      ]
    });

    chart.render();
  }

function pudelkowy(){
  var array0 = new Array();
  var array1 = new Array();
  var array2 = new Array();
  var array3 = new Array();
  var array4 = new Array();
  var row_size = 5;

  //minimalna
  var table = document.getElementById('zakresy');
  var id = 0;
  var r = 750;
  array0[id] = parseFloat(table.rows[r].cells[0].innerHTML);
  array1[id] = parseFloat(table.rows[r].cells[1].innerHTML);
  array2[id] = parseFloat(table.rows[r].cells[2].innerHTML);
  array3[id] = parseFloat(table.rows[r].cells[3].innerHTML);
  array4[id] = parseFloat(table.rows[r].cells[4].innerHTML);
  //maksymalna
  id = 3;
  r = 751;
  array0[id] = parseFloat(table.rows[r].cells[0].innerHTML);
  array1[id] = parseFloat(table.rows[r].cells[1].innerHTML);
  array2[id] = parseFloat(table.rows[r].cells[2].innerHTML);
  array3[id] = parseFloat(table.rows[r].cells[3].innerHTML);
  array4[id] = parseFloat(table.rows[r].cells[4].innerHTML);
  //Q2
  table = document.getElementById('mediany');
  id = 4;
  r = 750;
  array0[id] = parseFloat(table.rows[r].cells[0].innerHTML);
  array1[id] = parseFloat(table.rows[r].cells[1].innerHTML);
  array2[id] = parseFloat(table.rows[r].cells[2].innerHTML);
  array3[id] = parseFloat(table.rows[r].cells[3].innerHTML);
  array4[id] = parseFloat(table.rows[r].cells[4].innerHTML);
  //Q1
  table = document.getElementById('kwantyleQ1');
  //console.log(table.rows.length);
  id = 1;
  r = 750;
  array0[id] = parseFloat(table.rows[r].cells[0].innerHTML);
  array1[id] = parseFloat(table.rows[r].cells[1].innerHTML);
  array2[id] = parseFloat(table.rows[r].cells[2].innerHTML);
  array3[id] = parseFloat(table.rows[r].cells[3].innerHTML);
  array4[id] = parseFloat(table.rows[r].cells[4].innerHTML);
  //Q3
  id = 2;
  r = 751;
  array0[id] = parseFloat(table.rows[r].cells[0].innerHTML);
  array1[id] = parseFloat(table.rows[r].cells[1].innerHTML);
  array2[id] = parseFloat(table.rows[r].cells[2].innerHTML);
  array3[id] = parseFloat(table.rows[r].cells[3].innerHTML);
  array4[id] = parseFloat(table.rows[r].cells[4].innerHTML);
  //console.log(array0);
  var chart = new CanvasJS.Chart("chartContainer",
  {

    title:{
    text: "Dane - dawcy krwi"
    },
     data: [
       {
        type: "boxAndWhisker",
     		upperBoxColor: "#FF5A4D",
     		lowerBoxColor: "#7BCE69",
     		color: "black",
        dataPoints: [
          { label: "Recency (months)", y: array0 },
          { label: "Frequency (times)", y: array1 },
          { label: "Monetary (l blood)", y: array2 },
          { label: "Time (months)", y: array3 },
          { label: "whether he/she donated blood in March 2007", y: array4 },
        ]
      }
    ]
  });

  chart.render();
}

function oddalone(){
  var table = document.getElementById('oddalone');
  var array = new Array();
  var cells = 5;
  var id = 0;
  for (var r = 1, n = table.rows.length; r < n; r++) {
      for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
          array[id] = parseFloat(table.rows[r].cells[c].innerHTML);
          id++;
      }
  }
  //console.log(array);

  var chart = new CanvasJS.Chart("chartContainer",
	{
		title: {
			text: "Punkty oddalone"
		},
		axisY: {
			interval: 10,
		},
		axisX: {
			interval: 1,
			intervalType: "month",
			valueFormatString: "MMM"
			},
		data: [
		{
			type: "rangeColumn",
			color: "#369EAD",
			dataPoints: [
				{ label: "Recency (months)", y: [array[0], array[0+cells]] },  // y: [Low ,High]
				{ label: "Frequency (times)", y: [array[1], array[1+cells]] },
				{ label: "Monetary (l blood)", y: [array[2], array[2+cells]] },
				{ label: "Time (months)", y: [array[3], array[3+cells]] },
				{ label: "whether he/she donated blood in March 2007", y: [array[4], array[4+cells]] },
			]
		}
		]
	});
	chart.render();
}

$(document).ready(function(){
    $('.button').click(function(){
        var clickBtnValue = $(this).val();
        var ajaxurl = 'wyswietlDiv.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {

					if(response == 'poprawione'){
						$('#tekst').load('wyswietlPoprawione.php');
            poprawioneDane();
					}else if(response == 'oryginalne'){
						$('#tekst').load('wyswietlOryginalne.php');
            $('#chartContainer').load(clear());
					}else if(response == 'obrobka'){
						$('#tekst').load('obrobkaDanych.php');
            $('#chartContainer').load(clear());
					}else if(response == 'statystyki'){
						$('#tekst').load('statystykiOpisowe.php');
            //pudelkowy();
            srednie();
					}else if(response == 'oddalone'){
						$('#tekst').load('punktyOddalone.php');
            oddalone();
					}else if(response == 'pearson'){
						$('#tekst').load('pearson.php');
            pearson();
					}else if(response == 'regresja'){
						$('#tekst').load('regresjaLiniowa.php');
            regresjaLiniowa();
					}
        });
    });
});
