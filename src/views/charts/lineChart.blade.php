<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">{{ $chart->name }}
			<div class="pull-right panel-icons">
				<button class="btn btn-xs btn-default btn-primary btn-{{ $chart->id }}" id="btn-line-chart-{{ $chart->id }}">
					<i class="fa fa-line-chart"></i></button>
				<button class="btn btn-xs btn-default btn-{{ $chart->id }}" id="btn-bar-chart-{{ $chart->id }}">
					<i class="fa fa-bar-chart"></i></button>
				<button class="btn btn-xs btn-default btn-{{ $chart->id }}" id="btn-datatable-{{ $chart->id }}">
					<i class="fa fa-table"></i></button>
			</div>
			</div>
			<div class="panel-body">
				<div>
				<div class="pull-right">			
					<div class="form-group" style="display:inline;font-size:10px;">
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="1" checked="checked" /> SQL 1
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="2" checked="checked" /> SQL 2
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="3" checked="checked" /> SQL 3
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="4" checked="checked" /> SQL 4
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="5" checked="checked" /> SQL 5
					<input type="checkbox" class="chkbox-group-{{ $chart->id }}" value="6" checked="checked" /> SQL 6
					</div>
				</div>
				<div id="div-chart-{{ $chart->id }}" class="chart" style="width:100%;height:400px;display:inline-block"></div>
			</div>
			<div style="display:none" id="div-datatable-{{ $chart->id }}">
				<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">
					<thead>
					<tr>
						<th>Date</th>
						<th>SQL 1</th>
						<th>SQL 2</th>
						<th>SQL 3</th>
						<th>SQL 4</th>
						<th>SQL 5</th>
						<th>SQL 6</th>
					</tr>
					</thead>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>

	<script>
	$(function() {
		var chart1 = new cfx.Chart();
		var items = {{ $chart->data }};
		var tableInit = false;

		//chart options
		chart1.setGallery(cfx.Gallery.Lines);
		chart1.getAllSeries().setMarkerShape(cfx.MarkerShape.None);
		chart1.getAxisX().setLabelAngle(45);
		chart1.getAnimations().getLoad().setEnabled(true);
		//chart1.getAxisX().setAutoScroll(true);
		//chart1.getAxisX().setClientScroll(true);
		
		//create chart
		chart1.setDataSource(items);		
		chart1.create('div-chart-{{ $chart->id }}');

		//checkbox toggle series display
		$( ".chkbox-group-{{ $chart->id}}" ).click(function() 
		{
			var bToggle = $(this).is(":checked") ? true : false;
			chart1.getSeries().getItem($(this).val()-1).setVisible(bToggle);
		});

		//btn toggle between chart-type / datatable
		$( ".btn-{{ $chart->id }}" ).click(function() 
		{
			$('.btn-{{ $chart->id }}').toggleClass('btn-primary', false);
			$(this).toggleClass('btn-primary', true);				

			if($(this).attr('id') == 'btn-datatable-{{ $chart->id }}')
			{
				$('#div-datatable-{{ $chart->id }}').show();
				$('#div-chart-{{ $chart->id }}').parent().hide();
				if(!tableInit)
				{
					fnTableInit();
				}
			}
			else
			{
				$('#div-datatable-{{ $chart->id }}').hide();
				$('#div-chart-{{ $chart->id }}').parent().show();

				chart1.setGallery(($(this).attr('id') == 'btn-line-chart-{{ $chart->id}}') ? 1 : 2);
			}
		});		   
		   
		//datatable init   
		function fnTableInit()
		{
			tableInit = true;
		    $('#div-datatable-{{ $chart->id }} table').dataTable( 
		    {
		        "data": items,
		        "searching": false,
		        "order": [[0, 'desc' ]],
	    		"columns": [
		            { "data": "Mon DD" },
		            { "data": "SQL1" },
		            { "data": "SQL2" },
		            { "data": "SQL3" },
		            { "data": "SQL4" },
		            { "data": "SQL5" },
		            { "data": "SQL6" }
	   			 ]
	    	});
	    }   		
	});

	</script>

