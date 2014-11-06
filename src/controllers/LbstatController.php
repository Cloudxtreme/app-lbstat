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

		$charts = array(
			'Overview' => array(
				'charts' => array(
				100
				, 101
				, 102
				)
			)
			, 'Apps' => array(
				'charts' => array(
				200
				, 201
				, 202
				, 203
				, 204
				)
			)
		);

		$charts = json_encode([$charts]);
		
		$post = Mrcore::post()->prepare();
		return View::make('lbstat::index', compact(
			'post', 'charts'
		));
	}

	public function getChart($chart_id, $drange)
	{

		$chart = new \stdClass();
		$chart->id = $chart_id;

		switch($chart_id)
		{
			case 100:
				$chart->data = $this->repo->getClicksByDateServer($drange);	
				$chart->name = 'Total Clicks per Server by Date';
			break;
			case 101:
				$chart->data = $this->repo->getPageSizeByDateServer($drange);
				$chart->name = 'Average Page Size per Server by Date';
			break;
			case 102:
				$chart->data = $this->repo->getPageSpeedByDateServer($drange);	
				$chart->name = 'Average Page Speed per Server by Date';
			break;
			default:
				$chart->data = $this->repo->getPageSpeedByDateServer($drange);	
				$chart->name = '[Random Data]';
			break;
		}

		return View::make('lbstat::charts.lineChart', compact(
			'chart'
		));
	}

}
