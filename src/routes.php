<?php
\Lifecycle::add(__FILE__, 1);

Route::group(['prefix' => '/app/lbstat'], function() {

	Route::get('/', array(
	    'uses' => 'App\Lbstat\LbstatController@index'
	));

	Route::get('/getChart/{chartID}/{dateRange}', array(
		'uses' => 'App\Lbstat\LbstatController@getChart'
	));

});


