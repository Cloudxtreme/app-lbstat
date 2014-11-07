<?php namespace App\Lbstat;

use Mrcore;
use View;
use DB;
use Mssql;
use App\Lbstat\Repositories\LbstatRepositoryInterface;

class LbstatController extends \BaseController {

	protected $repo;

	public function __construct(LbstatRepositoryInterface $repo)
	{
		$this->repo = $repo;
	}

	/*
	get initial Load Balancer view & list of charts
	 */

	public function index()
	{
		\Lifecycle::add(__FILE__.' - '.__FUNCTION__);

		$chartData = [
			'Overview' => [
				'charts' => [
					100
					, 101
					, 102
					, 103 //test
					, 104 //test
					, 105 //test

				]
			]
			, 'Apps' => [
				'charts' => [
					200 //test
					, 201 //test
					, 202 //test
					, 203 //test
					, 204 //test
				]
			]
		];
		$chartData = json_encode([$chartData]);
		
		$post = Mrcore::post()->prepare();
		return View::make('lbstat::index', compact(
			'post', 'chartData'
		));
	}

	/*
	return chartDisplay view with appropriate chart data
	 */

	public function getChart($chartID, $dateRange)
	{

		$chart = new \stdClass();
			
		/* ChartTypes:
			0 - DataTable
			1 - Line Chart
	 		2 - Bar Chart
			3 - Area Chart
			5 - Pie Chart
			6 -	Curved Line
			8 - Step Line
			12 - Scatter
			13 - Doughnut
			15 - Bubble
			20 - Horizontal Bar
	 	*/
	 
	 	//chart defaults
 		$chart->id = $chartID;
		$chart->chartType = 1; //linechart default
		$chart->name = 'Data Chart';
		$chart->chartsAvailable = json_encode([1,2,0]); //chartTypes to allow switching		
		$chart->colSize = 12; //default column size
		$chart->doAnimate = false; //enable chart animation
		$chart->doScroll = false; //emable chart horizontal scrolling
		
		switch($chartID)
		{
			case 100:
				$data = $this->repo->getClicksByDateServer($dateRange);	
				$chart->name = 'Total Clicks per Server';	
				$chart->chartType = 1;							
				$chart->chartsAvailable = json_encode([0,1,2,3,5,6,8,12,13,15,20]);
				$chart->colSize = 12;				
			break;
			case 101:
				$data = $this->repo->getPageSizeByDateServer($dateRange);
				$chart->name = 'Average Page Size per Server';	
				$chart->chartType = 2;			
				$chart->colSize = 6;
				$chart->doAnimate = true;
			break;
			case 102:
				$data = $this->repo->getPageSpeedByDateServer($dateRange);	
				$chart->name = 'Average Page Speed per Server';
				$chart->chartType = 3;				
				$chart->chartsAvailable = json_encode([0,1,2,3,12,20]);
				$chart->colSize = 6;
			break;
			default:
				$data = $this->repo->getPageSpeedByDateServer($dateRange);					
			break;
		}

		//compact data for high date ranges
		/*if($dateRange >= 90)
		{
			if($dateRange == 90)
			{
				$num = 5;
			} else if($dateRange == 180)
			{
				$num = 15;
			} else {
				$num = 30;
			}
			$i = 0;
			foreach($data as $value) {
			    if ($i++ % $num == 0) {
			        $result[] = $value;
			    }
			}
			$data = json_encode($result);
		}*/

		$chart->data = $data;

		return View::make('lbstat::chartDisplay', compact(
			'chart'
		));
	}

}
