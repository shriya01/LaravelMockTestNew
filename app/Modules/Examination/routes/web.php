<?php

Route::group(['module' => 'Examination', 'middleware' => ['web'], 'namespace' => 'App\Modules\Examination\Controllers'], function() {

    Route::resource('Examination', 'ExaminationController');

});
