<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/api', [IndexController::class, 'index']);
//Route::get('/', '\App\Http\Controllers\Api\IndexController@index');
//Route::get('/','Api\IndexController@index');
Route::get('/text_login','Api\IndexController@textLogin');
Route::get('/text_token','Api\TextController@text_token');

Route::post('/pushDisposaApplicationForm','\App\Http\Controllers\Api\IndexController@pushDisposaApplicationForm');
Route::post('/uploadTargetSettlement','\App\Http\Controllers\Api\IndexController@uploadTargetSettlement');
Route::post('/approvalPushHighestPrice','\App\Http\Controllers\Api\IndexController@approvalPushHighestPrice');
Route::post('/getAuctionTargetNum','\App\Http\Controllers\Api\IndexController@getAuctionTargetNum');
Route::post('/getAuctionInfo','\App\Http\Controllers\Api\IndexController@getAuctionInfo');
Route::post('/getTargetInfo','\App\Http\Controllers\Api\IndexController@getTargetInfo');
Route::post('/getTargetStatementList','\App\Http\Controllers\Api\IndexController@getTargetStatementList');
Route::post('/getTargetParticipationList','\App\Http\Controllers\Api\IndexController@getTargetParticipationList');
Route::post('/getTargetWatcherInfo','\App\Http\Controllers\Api\IndexController@getTargetWatcherInfo');
Route::post('/send','\App\Http\Controllers\Api\TextController@send_succ');
Route::post('/syncCorpore','\App\Http\Controllers\Api\TextController@syncCorpore');
Route::post('/syncAuction','\App\Http\Controllers\Api\TextController@syncAuction');

Route::post('/pushDisposal','\App\Http\Controllers\Api\SdbjController@pushDisposaApplicationForm');
Route::post('/uploadTarget','\App\Http\Controllers\Api\SdbjController@uploadTargetSettlement');
Route::get('/getAuction','\App\Http\Controllers\Api\SdbjController@getAuction');
Route::post('/updateFankui','\App\Http\Controllers\Api\SdbjController@updateFankui');
Route::post('/updateEvaluate','\App\Http\Controllers\Api\SdbjController@updateEvaluate');