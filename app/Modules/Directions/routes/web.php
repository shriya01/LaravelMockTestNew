<?php

Route::group(['module' => 'Directions', 'middleware' => ['web'], 'namespace' => 'App\Modules\Directions\Controllers'], function() {

    Route::resource('Directions', 'DirectionsController');

});
