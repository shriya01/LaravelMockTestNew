<?php

Route::group(['module' => 'Category', 'middleware' => ['web'], 'namespace' => 'App\Modules\Category\Controllers'], function() {

    Route::resource('Category', 'CategoryController');

});
