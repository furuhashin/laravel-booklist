<?php


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//タスク一覧表示画面
Route::get('/', 'TasksController@index');

//タスクの新規追加画面
Route::get('/tasks/add', 'TasksController@add');
Route::post('/tasks/create','TasksController@create');

//任意IDのタスク表示
Route::get('/tasks/{id}','TasksController@show');

//任意IDのタスク編集
Route::get('/tasks/edit/{id}','TasksController@edit');
Route::post('/tasks/update/{id}','TasksController@update');

//任意IDのタスク削除
Route::post('/tasks/delete','TasksController@delete');




