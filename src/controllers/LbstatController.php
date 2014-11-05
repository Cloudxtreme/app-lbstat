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


		#$x = DB::connection('dyna-sql1')->table('tblApplications')->get();


		#$x = Mssql::query("SELECT * FROM dbo.tblApplications")->get();

		#dd($this->repo);

		$data = $this->repo->test()->toJson();

		#$x->count()
		#$x->first();

		#dd( $x );
		#dd( $x[0]->APP_Name );



		$post = Mrcore::post()->prepare();
		return View::make('lbstat::index', compact(
			'post', 'data'
		));
	}

}
