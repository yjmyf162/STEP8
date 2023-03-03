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

// 商品一覧表示
Route::get('/home/table', 'HomeController@showTable')->name('table');

// 商品情報の検索
Route::get('/home/search', 'HomeController@search')->name('search');

// 商品情報のソート
Route::get('/home/sort/id', 'HomeController@sortId')->name('sort-id');

// 商品情報のソート
Route::get('/home/sort/product_name', 'HomeController@sortProduct_name')->name('sort-product_name');

// 商品情報のソート
Route::get('/home/sort/price', 'HomeController@sortPrice')->name('sort-price');

// 商品情報のソート
Route::get('/home/sort/stock', 'HomeController@sortStock')->name('sort-stock');

// 商品情報のソート
Route::get('/home/sort/company_name', 'HomeController@sortCompany_name')->name('sort-company_name');

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
