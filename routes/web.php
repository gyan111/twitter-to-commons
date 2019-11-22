<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('logout', 'TwitterController@logout');
Route::get('authorize', 'TwitterController@authorizeApp');
Route::get('search', 'TwitterController@search');

Route::get('/', 'TwitterController@twitter');
Route::post('/', 'TwitterController@twitter');
Route::post('initialize-tweet', 'TwitterController@initializeTweet');
Route::post('get-tweet', 'TwitterController@getTweet');
Route::post('upload-tweet', 'TwitterController@uploadTweet');
Route::post('cancel-tweet', 'TwitterController@cancelTweet');
Route::get('uploads', 'TwitterController@uploads');
Route::get('canceled', 'TwitterController@canceled');
Route::get('statistics', 'TwitterController@statistics');
Route::get('administration', 'TwitterController@administration');
Route::post('ban', 'TwitterController@ban');
Route::get('delete/{id}', 'TwitterController@delete');
Route::get('request-new-account', 'TwitterController@requestAccount');
Route::post('request-new-account', 'TwitterController@requestAccount');
Route::get('approve/{id}', 'TwitterController@approve');
Route::get('reject/{id}', 'TwitterController@reject');




