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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::get('/{user}', ['as' => '', 'uses' => 'TaskController@index', 'middleware' => 'auth']);
Route::get('/{user}', 'TaskController@index')->name('index');

//Route::any('/registrar-tarea', ['as' => 'registrar.tarea', 'uses' => 'TaskController@registrar_tarea', 'middleware' => 'auth']);
Route::post('/registrar-tarea', 'TaskController@registrar_tarea')->name('registrar.tarea')->middleware('auth');

//Route::post('/{task}', ['as' => 'delete.task', 'uses' => 'TaskController@delete']);
Route::delete('/{task}', 'TaskController@delete')->name('delete.task');

//Route::any('/update-status/{task_id}/{status}', ['as' => 'update.status', 'uses' => 'TaskController@update_status']);
Route::get('/update-status/{task}/{status}', 'TaskController@update_status')->name('update.status');

//Route::any('/edit-task/{task_id}', ['as' => 'task.edit', 'uses' => 'TaskController@edit_task']);
Route::get('/edit-task/{task}', 'TaskController@edit_task')->name('task.edit');

//Route::any('/edit/{task_id}', ['as' => 'edit', 'uses' => 'TaskController@edit']);
Route::put('/edit/{task}', 'TaskController@edit')->name('edit');
