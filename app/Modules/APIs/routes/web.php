<?php

Route::group(['module' => 'API', 'middleware' => ['web'], 'namespace' => 'App\Modules\API\Controllers'], function() {

    Route::resource('API', 'APIController');

});
