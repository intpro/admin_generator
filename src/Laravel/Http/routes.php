<?php

Route::group(['namespace' => 'Interpro\AdminGenerator\Laravel\Http\Controllers','middleware' => 'auth', 'prefix' => 'adm'], function () {

    Route::get('/generate',        'AdminGeneratorController@generateAll');
    Route::get('/generate/{block}','AdminGeneratorController@generateBlock');

});