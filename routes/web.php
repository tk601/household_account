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
use App\Money;
use Illuminate\Http\Request;

//ダッシュボードの表示
Route::get('/','MoneysController@index');

//登録処理
Route::post('/moneys','MoneysController@store');

//更新画面
Route::post('/moneysedit/{moneys}','MoneysController@edit');

//更新処理
Route::post('/moneys/update','MoneysController@update');

//削除
Route::delete('/money/{money}','MoneysController@destroy');

//Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
