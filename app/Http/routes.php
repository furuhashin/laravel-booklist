<?php


/*
|--------------------------------------------------------------------------
| アプリケーションのルート
|--------------------------------------------------------------------------
|
| ここでアプリケーションのルートを全て登録することが可能です。
| 簡単です。ただ、Laravelへ対応するURIと、そのURIがリクエスト
| されたときに呼び出されるコントローラーを指定してください。
|
*/

// ログイン画面
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// ユーザー登録画面
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//本情報一覧表示画面
Route::get('/', 'BooksController@index');

//本情報削除確認画面
Route::get('/books/confirm/{id}', 'BooksController@confirm');

//本情報の新規追加画面
Route::get('/books/create', 'BooksController@create');
Route::post('/books','BooksController@store');

//任意IDの本情報表示
Route::get('/books/{id}','BooksController@show');

//任意IDの本情報編集
Route::get('/books/edit/{id}','BooksController@edit');
Route::post('/books/update/{id}','BooksController@update');

//任意IDの本情報削除
Route::post('/books/delete/{id}','BooksController@delete');

//コメントの追加
Route::post('/comments','CommentsController@store');

//任意IDのコメント編集
Route::get('/comments/edit/{id}','CommentsController@edit');
Route::post('/comments/update/{id}','CommentsController@update');

//任意IDのコメント削除
Route::post('/comments/delete/{id}','CommentsController@delete');

