@extends('layout.workbench')


@section('css')
	@parent
	<link href="{{ Workbench::asset('css/master.css') }}" rel="stylesheet">
	
@stop


@section('content')

@yield('wb-content')

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
