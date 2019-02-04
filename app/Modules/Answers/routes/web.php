<?php

Route::group(['module' => 'Answers', 'middleware' => ['web'], 'namespace' => 'App\Modules\Answers\Controllers'], function() {

    Route::resource('Answers', 'AnswersController');

});
