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

// Route::get('/', function () {
//     return view('welcome');
// });

//リスト一覧画面
Route::get('/', 'ListingsController@index');

//リスト新規画面
Route::get('/new', 'ListingsController@new')->name('new');

//リスト新規処理
Route::post('/listings', 'ListingsController@store');

//リスト更新画面
Route::get('/listings_edit/{listing_id}', 'ListingsController@edit');

//リスト更新処理
Route::post('/listings/edit', 'ListingsController@update');

//リスト削除処理
Route::get('/listings_delete/{listing_id}', 'ListingsController@delete' );

//ログイン認証
Auth::routes();

//ホーム画面
Route::get('/home', 'HomeController@index')->name('home');
