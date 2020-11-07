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

// //===ここから削除（トップページをリスト一覧画面にするため。未ログイン時はログイン画面に遷移します）===
// Route::get('/', function () {
//     return view('welcome');
// });
// //===ここまで削除===

//===ここから追加===
//リスト一覧画面
Route::get('/','ListingsController@index');

//リスト新規画面
Route::get('/newlist', 'ListingsController@newlist')->name('newlist');

//リスト新規処理
Route::post('/listings','ListingsController@store');

//リスト更新画面
Route::get('/listingsedit/{listing_id}', 'ListingsController@edit');

//リスト更新処理
Route::post('/listing/edit','ListingsController@update');

//リスト削除処理
Route::get('/listingsdelete/{listing_id}', 'ListingsController@destroy');
//===ここまで追加===

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');