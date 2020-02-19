<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::group(['middleware' => 'jwt.verify'], function() {


            });

           Route::post('/itki/store','ProductController@storeitki');
           Route::post('/save/barcode','prosesstock@savebarcode');
           Route::post('/update/itki','ProductController@updateitki');
           Route::post('/dele/barcode','ProductController@deletebarcode');
           Route::post('/histore/store','ProductController@storehistore');
           Route::post('/histore/update','ProductController@updatehistore');






