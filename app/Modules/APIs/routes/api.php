<?php

Route::group(['module' => 'API', 'middleware' => ['api'], 'namespace' => 'App\Modules\API\Controllers'], function() {

    Route::resource('API', 'APIController');

});
