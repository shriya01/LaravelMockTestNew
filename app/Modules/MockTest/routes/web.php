<?php

Route::group(['module' => 'MockTest', 'middleware' => ['web'], 'namespace' => 'App\Modules\MockTest\Controllers'], function() {

    Route::resource('MockTest', 'MockTestController');

});
