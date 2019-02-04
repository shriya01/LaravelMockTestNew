<?php

Route::group(['module' => 'Answers', 'middleware' => ['api'], 'namespace' => 'App\Modules\Answers\Controllers'], function() {

    Route::resource('Answers', 'AnswersController');

});
