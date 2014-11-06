@extends('lbstat::layout.master')

@section('wb-content')

	<div id="divCharts">
	</div>	
	
@stop

@section('script')
	@parent
	<script>
	var charts = {{ $charts }};
	
	function fnLoadCharts() {
		var chart_type = $('#ddlChartType').val();
		var date_range = $('#ddlDateRange').val();
		$('#divCharts').empty();
		
		for(var i=0;i<charts[0][chart_type]['charts'].length;i++) {
			$.ajax({
				url: 'lbstat/getChart/'+charts[0][chart_type]['charts'][i] +'/'+date_range
				/*, async: false*/
			}).done(function(data) {
				$('#divCharts').append(data);
			});
		}		
	}

	$( document ).ready(function() {
		fnLoadCharts();
	});

	</script>

@stop