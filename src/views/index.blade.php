@extends('lbstat::layout.master')

@section('wb-content')

	<div id="div-charts">
	</div>	
	
@stop

@section('script')
	@parent
	<script>
	var charts = {{ $chartData }};
	var counter =0;
	var totalRecords = 0;
	
	var chartType = '';
	var dateRange = '';

	//get filters and load charts
	function fnLoadCharts() {
		chartType = $('#ddlChartType').val();
		dateRange = $('#ddlDateRange').val();
		counter = 0;
		$('#div-charts').empty();
		totalRecords = charts[0][chartType]['charts'].length;

		fnAjaxLoadCharts();			
	}

	//ajax call to inject chart data
	function fnAjaxLoadCharts() {
		$.ajax({
			url: 'lbstat/getChart/'+charts[0][chartType]['charts'][counter] +'/'+dateRange
			/*, async: false*/
		}).done(function(data) {
			counter++;
			//load next chart if needed
			if(counter < totalRecords)
			{
				fnAjaxLoadCharts();
			}
			$('#div-charts').append(data);
		});
	}

	//load initial charts
	$( document ).ready(function() {
		fnLoadCharts();
	});

	//changing chart filters
	$( ".wb-lb-filter" ).change(function() {
		fnLoadCharts();
	});

	</script>

@stop