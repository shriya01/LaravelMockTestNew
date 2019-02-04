<?php

Route::group(['module' => 'Dashboard', 'middleware' => ['web'], 'namespace' => 'App\Modules\Dashboard\Controllers'], function() {

    Route::resource('dashboard', 'DashboardController');

});
