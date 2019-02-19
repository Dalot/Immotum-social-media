@extends('layouts.layout-projects')
@section('content')
    <h1 class="is-size-1">Create a Task</h1>
    
    <form method="POST" action="/tasks/{{$project->id}}">
        
        @csrf 
        
        <div class="field">
            <label class="is-size-3-tablet">Description</label>
            <div class="control">
                <textarea name="description" placeholder="Project description" class="textarea {{ $errors->has('description') ? 'is-danger' : ''  }}" rows="10">{{ old('description') }}</textarea>
            </div>
        </div>
        
        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link" type="submit">Create Task</button>
          </div>
        </div>
        
        @if ( $errors->any() )
          <div class="notification is-danger">
            <ul>
              @foreach($errors->all() as $error)
                <li>{{$error}}</li>
              @endforeach
            </ul>
          </div>
        @endif
    </form>
@endsection