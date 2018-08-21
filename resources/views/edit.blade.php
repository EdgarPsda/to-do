@extends('layouts.master')
@section('content')
<hr>
  <div class="row">
    <div class="col-md-6">
      <form action="{{route('edit',$task->id )}}" method="post">

        @csrf

        @method('PUT')

        <div class="form-group">
          <label for="exampleInputEmail1">Actualiza la tarea:</label>
          <textarea class="form-control" name="updateTask" rows="8" cols="80">{{$task->task}}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">actualizar</button>
      </form>
    </div>
  </div>
@endsection
