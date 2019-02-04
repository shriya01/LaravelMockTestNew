<?php

Route::group(['module' => 'Category', 'middleware' => ['api'], 'namespace' => 'App\Modules\Category\Controllers'], function() {

    Route::resource('Category', 'CategoryController');

});
