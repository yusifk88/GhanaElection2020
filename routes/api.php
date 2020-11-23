<?php

use Illuminate\Http\Request;
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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('constituencies','ConstituenciesController@index');
Route::get('partiesandpressresults','PartiesController@index');
Route::get('partiesandprlresults/{constituency_id}','PartiesController@parlresults');
Route::get('presscandidateresult/{id}','PartiesController@show');
Route::get('parlcandidateresult/{id}','PartiesController@showparl');
