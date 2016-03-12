<?php

Route::group(['namespace' => 'Interpro\AdminGenerator\Laravel\Http\Controllers'], function () {

    Route::get('/','AdminGeneratorController@index');

});