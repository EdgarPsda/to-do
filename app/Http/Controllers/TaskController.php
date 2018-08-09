<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

public function index(Request $request)
{
  $tasks = Task::select()->where('user_id',$request->user()->id)->get();
  // dd($tasks);
  return view('index', compact('tasks'));
}

public function registrar_tarea(Request $request)
{
  $task = new Task();
  $task->user_id = $request->user()->id;
  $task->task = $request->input('task');
  $task->status = 'New';
  $task->save();

  return redirect('/')->with('message', 'tarea-creada');
}

public function delete($task_id)
{
  $task = new Task();
  $task = Task::select()->where('id', $task_id)->delete();
  return redirect('/')->with('message', 'tarea-eliminada');
}

// Update status
public function update_status($task_id, $status)
{
  $task = new Task();
  $task = Task::where('id',$task_id)->update(['status' => $status]);
  return redirect('/')->with('message', 'status-actualizado');
}

public function edit($task_id, Request $request)
{

  $task = new Task();
  $task = Task::where('id',$task_id)->update(['task' => $request->input('updateTask')]);
  return redirect('/')->with('message', 'tarea-actualizada');
}

public function edit_task($task_id)
{
  $task = new Task();
  $task = Task::select()->where('id', $task_id)->get();
  return view('edit', compact('task'));
  // $task = Task::where('id',$task_id)->update(['task' => $task]);
  // return redirect('/')->with('message', 'task-updated');
}
}
