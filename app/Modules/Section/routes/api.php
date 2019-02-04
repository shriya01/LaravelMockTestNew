<?php

Route::group(['module' => 'Section', 'middleware' => ['api'], 'namespace' => 'App\Modules\Section\Controllers'], function() {

    Route::resource('section', 'SectionController');

});
