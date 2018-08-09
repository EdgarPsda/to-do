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


Route::get('/', ['as' => 'index', 'uses' => 'TaskController@index', 'middleware' => 'auth']);

Route::any('/registrar-tarea', ['as' => 'registrar.tarea', 'uses' => 'TaskController@registrar_tarea', 'middleware' => 'auth']);

Route::any('/delete-task/{task_id}', ['as' => 'delete.task', 'uses' => 'TaskController@delete']);

Route::any('/update-status/{task_id}/{status}', ['as' => 'update.status', 'uses' => 'TaskController@update_status']);

Route::any('/edit-task/{task_id}', ['as' => 'task.edit', 'uses' => 'TaskController@edit_task']);

Route::any('/edit/{task_id}', ['as' => 'edit', 'uses' => 'TaskController@edit']);

Auth::routes();

if (Auth::guest()) {
  return redirect('auth.login');
}
