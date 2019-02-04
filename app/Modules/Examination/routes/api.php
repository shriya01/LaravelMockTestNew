<?php

Route::group(['module' => 'Examination', 'middleware' => ['api'], 'namespace' => 'App\Modules\Examination\Controllers'], function() {

    Route::resource('Examination', 'ExaminationController');

});
