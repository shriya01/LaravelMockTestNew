<?php

Route::group(['module' => 'QuestionSets', 'middleware' => ['web'], 'namespace' => 'App\Modules\QuestionSets\Controllers'], function() {

    Route::resource('QuestionSets', 'QuestionSetsController');

});
