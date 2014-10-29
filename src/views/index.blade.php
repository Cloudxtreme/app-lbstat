@extends('lbstat::layout')

@section('wb-content')

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Total Requests/Day</h3>
				</div>
				<div class="panel-body chart-panel">
					<canvas id="totalChart" width="400" height="400"></canvas>

				</div>
				<div class="row">
				<div id='xx'></div>
				</div>
			</div>
		</div>
	</div>
	
@stop



@section('script')
	@parent
	<script>
	$(function() {
		// Get Chart context
		var totalChartContext = $("#totalChart").get(0).getContext("2d");

		// Set graph defaults
		Chart.defaults.global.responsive = true;
		//Chart.defaults.global.showScale = false;
		Chart.defaults.global.maintainAspectRatio = false;

		var data = {
			labels: ["2014-08-11", "2014-08-12", "2014-08-13", "2014-08-14"],
			datasets: [
				{
					label: "Requests",
					fillColor: "rgba(220,220,220,0.5)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: [306773, 259849, 239634, 292015]
				},
				{
					label: "Internal",
					fillColor: "rgba(151,187,205,0.9)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: [64858, 34533, 21633, 64891]
				},
				{
					label: "External",
					fillColor: "rgba(151,187,205,0.5)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: [241915, 225316, 218001, 230124]
				}		        
			]
		};
		var totalChart = new Chart(totalChartContext).Line(data, {
			legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span class=\"legend-item\" style=\"background-color:<%=datasets[i].fillColor%>\"></div><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
		});

		$('#xx').html(totalChart.generateLegend());


	});

	</script>

@stop