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

//タスク一覧表示画面
Route::get('/', 'TasksController@index');

//コメントの追加
Route::post('/comments','CommentsController@store');

//タスク削除確認画面
Route::get('/tasks/confirm/{id}', 'TasksController@confirm');

//タスクの新規追加画面
Route::get('/tasks/create', 'TasksController@create');
Route::post('/tasks','TasksController@store');

//任意IDのタスク表示
Route::get('/tasks/{id}','TasksController@show');

//任意IDのタスク編集
Route::get('/tasks/edit/{id}','TasksController@edit');
Route::post('/tasks/update/{id}','TasksController@update');

//任意IDのタスク削除
Route::post('/tasks/delete','TasksController@delete');



