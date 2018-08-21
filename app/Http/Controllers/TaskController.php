<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(User $user)
    {
    //  $tasks = Task::select()->where('user_id',$request->user()->id)->get();
    //
    //  return view('index', compact('tasks'));

        return view('index', [

            'tasks' => Task::where('user_id', $user->id)->get()

        ]);
    }

    public function registrar_tarea(Request $request)
    {
      $task = new Task();
      $task->user_id = auth()->id();
      $task->task = $request->input('task');
      $task->status = 'New';
      $task->save();

    //  return redirect('/')->with('message', 'tarea-creada');

      return redirect()->route('index', $task->user->id)->with('message', 'tarea-creada');
    }

    public function delete(Task $task)
    {
    //  $task = new Task();
    //  $task = Task::select()->where('id', $task_id)->delete();

        $task->delete();

        return redirect()->back()->with('message', 'tarea-eliminada');
    }

    // Update status
    public function update_status(Task $task, $status)
    {
    //  $task = Task::where('id',$task_id)->update(['status' => $status]);

        $task->update(['status' => $status]);

      return redirect()->route('index', $task->user->id)->with('message', 'status-actualizado');
    }

    public function edit(Request $request, Task $task)
    {

    //  $task = new Task();
    //  $task = Task::where('id',$task_id)->update(['task' => $request->input('updateTask')]);
    //  return redirect('/')->with('message', 'tarea-actualizada');

        $task->update(['task' => $request->input('updateTask')]);

        return redirect()->route('index', auth()->id())->with('message', 'tarea-actualizada');
    }

    public function edit_task(Task $task)
    {
    //  $task = new Task();
    //  $task = Task::select()->where('id', $task_id)->get();
    //  return view('edit', compact('task'));

        return view('edit', [

            'task' => $task

        ]);
    }
}
