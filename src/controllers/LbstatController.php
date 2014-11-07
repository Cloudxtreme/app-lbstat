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

	public function index()
	{
		\Lifecycle::add(__FILE__.' - '.__FUNCTION__);

		$chartData = [
			'Overview' => [
				'charts' => [
					100
					, 101
					, 102
				]
			]
			, 'Apps' => [
				'charts' => [
					200
					, 201
					, 202
					, 203
					, 204
				]
			]
		];
		$chartData = json_encode([$chartData]);
		
		$post = Mrcore::post()->prepare();
		return View::make('lbstat::index', compact(
			'post', 'chartData'
		));
	}

	public function getChart($chartID, $dateRange)
	{

		$chart = new \stdClass();
		$chart->id = $chartID;

		switch($chartID)
		{
			case 100:
				$chart->data = $this->repo->getClicksByDateServer($dateRange);	
				$chart->name = 'Total Clicks per Server by Date';				
			break;
			case 101:
				$chart->data = $this->repo->getPageSizeByDateServer($dateRange);
				$chart->name = 'Average Page Size per Server by Date';
			break;
			case 102:
				$chart->data = $this->repo->getPageSpeedByDateServer($dateRange);	
				$chart->name = 'Average Page Speed per Server by Date';

			break;
			default:
				$chart->data = $this->repo->getPageSpeedByDateServer($dateRange);	
				$chart->name = '[Random Data]';
			break;
		}

		return View::make('lbstat::charts.lineChart', compact(
			'chart'
		));
	}

}
