<?php

Route::group(['module' => 'QuestionSets', 'middleware' => ['api'], 'namespace' => 'App\Modules\QuestionSets\Controllers'], function() {

    Route::resource('QuestionSets', 'QuestionSetsController');

});
