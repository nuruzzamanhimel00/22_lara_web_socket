<?php

use App\Events\WebsocketDemoEvent;
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

    broadcast( new WebsocketDemoEvent( 'pass some data' ) );

    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/messages', 'CartController@fetchMessages')->name('fetch.messages');
Route::post('/messages', 'CartController@sendMessages')->name('send.messages');

Route::get('/carts', 'CartController@index')->name('carts');
