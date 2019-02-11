<?php

Route::group(['module' => 'Package', 'middleware' => ['api'], 'namespace' => 'App\Modules\Package\Controllers'], function() {

    Route::resource('Package', 'PackageController');

});
