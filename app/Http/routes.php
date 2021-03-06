<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Google Authentication
Route::get('/authentication', 'AuthenticationController@getIndex');
Route::post('/authentication/check', 'AuthenticationController@postCheck');

// Google reCAPTCHA
Route::get('/recaptcha', 'RecaptchaController@getIndex');
Route::post('/recaptcha/check', 'RecaptchaController@postCheck');

Route::get('/notification', function () {
    return view('notification');
});

// 圖片處理
Route::get('/image/{type?}', 'ImageController@getIndex');

// Excel
Route::get('/excel', 'ExcelController@getIndex');

Route::get('/', function () {
    return view('welcome');
});

// Telegram 推播 
Route::get('/getTelegram', 'TelegramController@getInfo');
Route::get('/sendTelegram/{message?}', 'TelegramController@sendMessage');