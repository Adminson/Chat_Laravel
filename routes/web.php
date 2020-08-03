<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'ChatController@chat')->name('home');


Route::post('send', 'ChatController@send');


Route::post('saveToSession','ChatController@saveToSession');
Route::post('deleteSession','ChatController@deleteSession');
Route::post('getOldMessage','ChatController@getOldMessage');
Route::get('check',function(){
	return session('chat');
});




//voting 

Route::get('/admin/vote/{counterId}', 'VoteController@adminCounter');
Route::get('/vote/{counterId}', 'VoteController@vote');
Route::post('vote', 'VoteController@startVote');