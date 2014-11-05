<?php namespace App\Lbstat;

use Illuminate\Support\ServiceProvider;

class LbstatServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		\Lifecycle::add(__FILE__.' - '.__FUNCTION__);

		$this->package('app/lbstat');
		include __DIR__.'/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		\Lifecycle::add(__FILE__.' - '.__FUNCTION__);

		$this->app->bind('Mreschke\Dbal\DbalInterface', 'Mreschke\Dbal\Mssql');
		$this->app->bind('App\Lbstat\Repositories\LbstatRepositoryInterface', 'App\Lbstat\Repositories\MssqlLbstatRepository');

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}