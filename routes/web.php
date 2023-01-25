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

//Route::get('/', function () {
    //return view('welcome');
//});

Auth::routes();

// ホーム画面
Route::get('/home', 'HomeController@index')->name('home');

// 商品情報の検索
Route::get('/home/search', 'HomeController@index')->name('search');

// 商品情報の削除
Route::post('/home/delete/{id}', 'HomeController@exeDelete')->name('delete');

// テスト画面
Route::get('/test', 'ArticleController@showTest')->name('test');

// 商品一覧画面
Route::get('/list', 'ArticleController@showList')->name('list');

// 商品情報登録画面
Route::get('/home/create', 'HomeController@showCreate')->name('create');

// 商品情報の登録
Route::post('/home/regist', 'HomeController@exeRegist')->name('regist');

// 商品詳細画面
Route::get('/home/{id}', 'HomeController@showDetail')->name('detail');


// 商品編集画面
Route::get('/home/{id}/edit', 'HomeController@showEdit')->name('edit');

// 商品情報の編集
Route::post('/home/update', 'HomeController@exeUpdate')->name('update');
