<?php

Route::group(['module' => 'Post', 'middleware' => ['api'], 'namespace' => 'App\Modules\Post\Controllers'], function() {

    Route::resource('Post', 'PostController');

});
