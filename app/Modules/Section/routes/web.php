<?php

Route::group(['module' => 'Section', 'middleware' => ['web'], 'namespace' => 'App\Modules\Section\Controllers'], function() {

    Route::resource('section', 'SectionController');

});
