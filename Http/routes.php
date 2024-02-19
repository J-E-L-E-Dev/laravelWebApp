<?php

Route::group(['as' => 'laravelwebapp.'], function()
{
    Route::get('/manifest.json', 'LaravelWebAppController@manifestJson')
    ->name('manifest');
    Route::get('/offline/', 'LaravelWebAppController@offline');
});
