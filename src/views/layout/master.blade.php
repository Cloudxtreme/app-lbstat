@extends('layout.workbench')

@section('css')
	@parent
	<link href="//css.dynatronsoftware.com/jchartfx/jchartfx.attributes.css" rel="stylesheet">

	<style>

		.body, .no-container .body {
			padding: 0px 0px 0px 0px;
		}

		select {
			display:inline;
			margin-top:5px;
		}

		#divCharts {
			margin-top:15px;
		}

		.wb-subheader {
			border-bottom:1px solid #dddddd;
			background-color:#ededed;
		}

		.wb-subheader-row {
			border-left:1px solid #dddddd;
			border-right:1px solid #dddddd;
			height:45px;
		}

		.wb-subheader-label div {
			font-weight:bold;
			font-size:18px;
			height:45px;
			padding-top:10px;
		}

		.panel-heading {
			font-weight:bold;
			color:#666666 !important;
		}

	</style>
@stop


@section('content')

	<div class="wb-subheader">
		<div class="container">
			<div class="row wb-subheader-row">
				<div class="col-md-3 wb-subheader-label bg-primary">
					<div class="text-default"><i class="fa fa-sliders fa-large"></i> Load Balancer</div>
				</div>
				<div class="col-md-6 wb-subheader-content">
					<select name="ddlChartType" id="ddlChartType" class="form-control" style="width:250px;" onchange="fnLoadCharts()">
						<option value="Overview" selected="selected">Overview Charts</option>
						<option value="Apps">App Charts</option>
						<option value="Pages">Page Charts</option>
					</select>
				</div>
				<div class="col-md-3 wb-subheader-cap text-right">
					<select name="ddlDateRange" id="ddlDateRange" class="form-control" style="width:150px;display:inline;" onchange="fnLoadCharts()">
						<option value="30">30 Days</option>
						<option value="60">60 Days</option>
						<option value="90" selected="selected">90 Days</option>
						<option value="180">180 Days</option>
						<option value="365">1 Year</option>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="wb-content col-md-12">
				@yield('wb-content')
			</div>
		</div>
	</div>
@stop


@section('script')
	@parent
	<script src="//scripts.dynatronsoftware.com/jchartfx/jchartfx.system.js"></script>
	<script src="//scripts.dynatronsoftware.com/jchartfx/jchartfx.coreVector.js"></script>
@stop
