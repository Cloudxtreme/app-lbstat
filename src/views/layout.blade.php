@extends('layout.workbench')


@section('css')
	@parent
	<link href="{{ Workbench::asset('css/master.css') }}" rel="stylesheet">
	<style>
	.chart-panel {
		padding: 5px;
		margin-right: 10px;
	}	
	</style>
@stop


@section('content')

<div class="tabbable">
	<? $tab = Request::segment(3); if (!$tab) $tab = 'home'; ?>
	<ul class="nav nav-tabs" id="vfiTabs">

		<li <?=($tab == 'home' ? 'class="active"' : '') ?>>
			<a href="{{ action('App\Lbstat\LbstatController@index') }}">
				<i class="icon-home green bigger-110"></i>
				Home
			</a>
		</li>

		<li <?=($tab == 'test' ? 'class="active"' : '') ?>>
			<a href="{{ action('App\Lbstat\LbstatController@index') }}">
				<i class="icon-home green bigger-110"></i>
				Testtab
			</a>
		</li>

	</ul>

	<div class="tab-content">
		<div class='tab-pane active'>
			@yield('wb-content')
		</div>


	</div>
</div>

@stop


@section('script')
	@parent
	<script src="{{ Workbench::asset('js/master.js') }}"></script>
	<script src="http://scripts.dynatronsoftware.com/Chart.min.js"></script>
	<script>
		$(function() {
			
		});
	</script>
@stop
