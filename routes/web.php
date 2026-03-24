<?php

use App\Http\Controllers\TwitterController;
use Illuminate\Support\Facades\Route;

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

Route::get('logout', [TwitterController::class, 'logout']);
Route::get('authorize', [TwitterController::class, 'authorizeApp']);
Route::get('search', [TwitterController::class, 'search']);

Route::get('/', [TwitterController::class, 'twitter']);
Route::post('/', [TwitterController::class, 'twitter']);
Route::post('initialize-tweet', [TwitterController::class, 'initializeTweet']);
Route::post('get-tweet', [TwitterController::class, 'getTweet']);
Route::post('upload-tweet', [TwitterController::class, 'uploadTweet']);
Route::post('cancel-tweet', [TwitterController::class, 'cancelTweet']);
Route::get('uploads', [TwitterController::class, 'uploads']);
Route::get('canceled', [TwitterController::class, 'canceled']);
Route::get('statistics', [TwitterController::class, 'statistics']);
Route::get('administration', [TwitterController::class, 'administration']);
Route::post('ban', [TwitterController::class, 'ban']);
Route::get('delete/{id}', [TwitterController::class, 'delete']);
Route::get('request-new-account', [TwitterController::class, 'requestAccount']);
Route::post('request-new-account', [TwitterController::class, 'requestAccount']);
Route::get('approve/{id}', [TwitterController::class, 'approve']);
Route::get('reject/{id}', [TwitterController::class, 'reject']);




