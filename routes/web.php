<?php

use App\Http\Controllers\HomeController;
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

Route::get('/house','HomeController@index');
Route::get('/','IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/parliamentary/record', 'HomeController@selectconstituency')->name('SelectConstituency');
Route::get('/presidential/record', 'HomeController@selectconstituencypresidential')->name('SelectConstituencyPresidential');
Route::get('/parliamentary/record/{id}', 'HomeController@recordparliamentary')->name('RecordParliamentary');
Route::get('/presidential/record/{id}', 'HomeController@recordpresidential')->name('RecordPresidential');
Route::get('/parliamentary/delete/{id}', 'HomeController@deletevote')->name('DeleteVote');
Route::post('saveMPresults',"HomeController@savempresults")->name('SaveParliamentryResult');
Route::get('constituency/create','HomeController@createconstituency')->name('createconstituency');
Route::get('pollingstation/create','HomeController@createpollingstation')->name('createpollingstation');
Route::post('constituency/save','HomeController@saveconstituency')->name('saveconstituency');
Route::post('pollingstation/save','HomeController@savepollingstation')->name('savepollingstation');
Route::get('user/create','HomeController@createuser')->name('createuser');
Route::post('user/save','HomeController@saveuser')->name('saveuser');
Route::get('paliarmentarycandidate/create','HomeController@createpaliarmentarycandidate')->name('createpaliarmentarycandidate');
Route::post('paliarmentarycandidate/save','HomeController@saveparliamentarycandidate')->name('saveparliamentarycandidate');

Route::get('/home', 'HomeController@index')->name('home');
