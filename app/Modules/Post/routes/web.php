<?php

Route::group(['module' => 'Post', 'middleware' => ['web'], 'namespace' => 'App\Modules\Post\Controllers'], function() {

    Route::resource('Post', 'PostController');

});
