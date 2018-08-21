@extends('layouts.master')
@section('content')
<!-- Notifications -->
<div class="row-fluid">
  <div id="success" class="alert alert-success" style="display: none;">
    <strong>Success!</strong> the task has been created.
  </div>
</div>

<div class="row-fluid">
  <div id="deleted" class="alert alert-info" style="display: none;">
    <strong>Done!</strong> the task has been deleted.
  </div>
</div>

<div class="row-fluid">
  <div id="updated" class="alert alert-info" style="display: none;">
    <strong>Done!</strong> the status has been updated.
  </div>
</div>

<div class="row-fluid">
  <div id="update" class="alert alert-info" style="display: none;">
    <strong>Updated!</strong> the current task has been updated.
  </div>
</div>
<!-- end notifications -->

<hr>
  <div class="row">
    <div class="col-md-6">
      <form action="{{route('registrar.tarea')}}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputEmail1">Crear una tarea:</label>
          <textarea class="form-control" name="task" rows="8" cols="80"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">enviar</button>
      </form>
    </div>

    <div class="col-md-6">
      <h3>Mis Tareas</h3>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">User</th>
            <th scope="col">Task</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tasks as $task)
          <tr>
            <th scope="row">{{$task->user_id}}</th>
            <td>{{$task->task}}</td>
            <td>{{$task->status}}</td>
            <td>
              <div class="btn-group" role="group">
                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Opciones
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                  <a class="dropdown-item" href="{{route('task.edit', $task->id)}}">Edit</a>

                  <form action="{{ route('delete.task', $task->id) }}" method="post">

                    @csrf

                    @method('DELETE')

                    <button class="dropdown-item">
                      Delete
                    </button>

                  </form>

                  @if($task->status == 'New')
                    <a class="dropdown-item" href="{{route('update.status', [$task->id, 'In progress'])}}">Start</a>
                  @elseif($task->status == 'In progress')
                    <a class="dropdown-item" href="{{route('update.status', [$task->id, 'Complete'])}}">Complete</a>
                  @endif
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @if(session('message') == 'tarea-creada')
    <script type="text/javascript">
        $('#success').fadeIn(1000);
        $('#success').delay(3000).fadeOut(1000);
    </script>
    @endif

    @if(session('message') == 'tarea-eliminada')
    <script type="text/javascript">
        $('#deleted').fadeIn(1000);
        $('#deleted').delay(3000).fadeOut(1000);
    </script>
    @endif

    @if(session('message') == 'status-actualizado')
    <script type="text/javascript">
        $('#updated').fadeIn(1000);
        $('#updated').delay(3000).fadeOut(1000);
    </script>
    @endif

    @if(session('message') == 'tarea-actualizada')
    <script type="text/javascript">
        $('#update').fadeIn(1000);
        $('#update').delay(3000).fadeOut(1000);
    </script>
    @endif
  </div>


@endsection
