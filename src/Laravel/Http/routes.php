<?php

Route::group(['namespace' => 'Interpro\AdminGenerator\Laravel\Http\Controllers'], function () {

    Route::get('/generate','AdminGeneratorController@index');

});