<?php
\Lifecycle::add(__FILE__, 1);

Route::group(['prefix' => '/app/lbstat'], function() {

	Route::get('/', array(
	    'uses' => 'App\Lbstat\LbstatController@index'
	));

	Route::get('/getChart/{chart_id}/{day_range}', array(
		'uses' => 'App\Lbstat\LbstatController@getChart'
	));

});


