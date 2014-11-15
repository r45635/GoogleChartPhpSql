<html>
  <head>
    <meta charset="utf-8">
    <title>MySqlData to GoogleChart Example</title>

	<!--Load the AJAX API-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
    
	function getParameterByName(name) {
		var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
		return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
	}
	
      google.load('visualization', '1.0', {'packages':['corechart']});
	  google.setOnLoadCallback(drawChart);

function drawChart() {

      var jsonDataTemp = $.ajax({
          url: "_getLightData.php?t=SENSOR_DHT&f=temperature&u=HOURLY",
          dataType:"json",
          async: false
          }).responseText;

      var jsonDataHumi = $.ajax({
          url: "_getLightData.php?t=SENSOR_DHT&f=humidity&u=HOURLY",
          dataType:"json",
          async: false
          }).responseText;		  

    var dataTemp = new google.visualization.DataTable(jsonDataTemp);
    var chartTemp = new google.visualization.AreaChart(document.getElementById('chart_div_temp'));
	var optionsTemp = {
          title: 'Temperature (Degree C)',
		  legend: 'none',
		  chartArea: {left:'30', top:'30', width:'95%'}
        };
  chartTemp.draw(dataTemp, optionsTemp);
 
	var dataHumi = new google.visualization.DataTable(jsonDataHumi);
	var chartHumi = new google.visualization.AreaChart(document.getElementById('chart_div_humi'));
  	var optionsHumi = {
          title: 'Humidity (%)',
          vAxis: {minValue: 0},
		  legend: 'none',
		  chartArea: {left:'30', top:'30', width:'95%'}
        };
  chartHumi.draw(dataHumi, optionsHumi); 
  }

    </script>
</head>

<body>
  <CENTER><H1>Exemple of GoogleChart data from mySQL PHP query</H1></CENTER>
  <table style="width:100%">
  <tr>
    <td><div id="chart_div_temp"></div></td>
	<td style="width:20%">
	<?php 
	echo 'SENSOR_DHT<br><a href="_getLightData.php?t=SENSOR_DHT&f=temperature&u=HOURLY">temperature</a>';
	?>
	</td>
  </tr>
  <tr>
	<td><div id="chart_div_humi"></div></td>
	<td style="width:20%">
	<?php
	echo 'SENSOR_DHT<br><a href="_getLightData.php?t=SENSOR_DHT&f=humidity&u=HOURLY">humidity</a>';
	?>
	</td>
  </tr>
  </table>
  </body>
  </html>
<!-- Vincent(at>Cruvellier(dot)eu -->