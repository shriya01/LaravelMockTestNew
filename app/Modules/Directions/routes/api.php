<?php

Route::group(['module' => 'Directions', 'middleware' => ['api'], 'namespace' => 'App\Modules\Directions\Controllers'], function() {

    Route::resource('Directions', 'DirectionsController');

});
