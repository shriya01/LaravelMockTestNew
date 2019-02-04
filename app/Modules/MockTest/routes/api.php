<?php

Route::group(['module' => 'MockTest', 'middleware' => ['api'], 'namespace' => 'App\Modules\MockTest\Controllers'], function() {

    Route::resource('MockTest', 'MockTestController');

});
