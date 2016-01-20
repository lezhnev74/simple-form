<?php

Route::group(['middleware' => ['web','locale']], function () {
    Route::get('/', ['uses'=>'ContactFormController@form']);
    Route::post('/', ['uses'=>'ContactFormController@send']);
});
