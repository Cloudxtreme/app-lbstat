<?php namespace App\Lbstat;

use Mrcore;
use View;


class LbstatController extends \BaseController {

	public function index()
	{
		\Lifecycle::add(__FILE__.' - '.__FUNCTION__);

		/*$query = "
			SELECT date, sum(req) as req, sum(req_internal) as req_internal, sum(req_external) as req_external --avg_size avg_speed
			FROM [Utility].[dbo].[tbl_stat_lb]
			WHERE datepart(dw, date) not in (1,7) --1=sunday, 7=saturday
			group by date
			order by date
		";*/

		#$x = \Mssql::connection('dyna-sql6')->query($query)->get();

		#dd($x->collapse());

		$post = Mrcore::post()->prepare();
		return View::make('lbstat::index', compact(
			'post'
		));
	}

}
