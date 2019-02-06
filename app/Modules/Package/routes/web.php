<?php

Route::group(['module' => 'Package', 'middleware' => ['web'], 'namespace' => 'App\Modules\Package\Controllers'], function() {

    Route::resource('Package', 'PackageController');

});
