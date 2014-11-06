<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">{{ $chart->name }}</div>
			<div class="panel-body">
			<div id="divChart_{{ $chart->id }}" class="chart" style="width:100%;height:400px;display:inline-block"></div>
			</div>
		</div>
	</div>
</div>

	<script>
	$(function() {
		var chart1 = new cfx.Chart();
		chart1.setGallery(cfx.Gallery.Lines);
		chart1.getAllSeries().setMarkerShape(cfx.MarkerShape.None);
		var items = {{ $chart->data }};
		chart1.getAxisX().setLabelAngle(45);
		//chart1.getAxisX().setAutoScroll(true);
		//chart1.getAxisX().setClientScroll(true);
				
		chart1.setDataSource(items);
		
		chart1.create('divChart_{{ $chart->id }}');
	});

	</script>

