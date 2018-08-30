<?php

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'PaymentController@index')->name('home');
    Route::get('/payments','PaymentController@index')->name('payments.index');
    Route::get('/payments/create','PaymentController@create')->name('payments.create');
    Route::post('/payments','PaymentController@store')->name('payments.store');
});

Auth::routes();