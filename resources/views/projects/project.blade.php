@extends('layouts.layout-projects')
@push('styles')
<link rel="stylesheet" href="{{asset('css/spacing.css')}}" type="text/css" />
<link rel="stylesheet" href="{{asset('css/project.css')}}" type="text/css" />
@endpush

@section('content')
    <h1 class="is-size-1">My First Website</h1>
    
     <a class="button is-info m-md" href="/projects">
      Back
    </a>
    
    <div class="tile is-ancestor">
        
      
        <div class="tile is-parent ">
            <div class="tile is-child box notification is-info">
                
                  <p class="is-size-3">{{$project->title}}</p>
                <div class="content is-size-5">
                  {{$project->description}}
                </div>
                <a class="button is-primary" href="/projects/{{$project->id}}/edit">
                  Edit
                </a>
                <a class="button is-danger" href="/projects/{{$project->id}}/edit">
                  Delete
                </a>
                
            </div>
        </div> 
    </div>
    
    
    
    @if ( $project->tasks->count() )
      @foreach($project->tasks->chunk(3) as $chunk)
        
        <div class="columns">
         
          @foreach ($chunk as $task)
            <article class="message is-dark is-one-third column">
              <div class="message-header">
                
                <form method="POST" action="/completed-tasks/{{ $task->id }}" >
                  
                  @if($task->completed)
                    @method('DELETE')
                  @endif
                  
                  @csrf
                  
                  <label for="completed" class="checkbox">
                    <input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                  </label>
                
                </form>
                
                <p class="{{ $task->completed ? 'is-complete' : '' }}">{{ $task->description }}</p>
                <button class="delete" aria-label="delete"></button>
              </div>
            </article>
          @endforeach
        
        </div>
      
      @endforeach
    @endif
    
    <form method="POST" action="/projects/{{$project->id}}/tasks">
        
        @csrf 
        
        <div class="box">
           
            
                <input name="description" placeholder="Task Description" class="box {{ $errors->has('description') ? 'is-danger' : ''  }}" value="{{ old('description') }}">
            
        </div>
        
        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link" type="submit">Create Task</button>
          </div>
        </div>
        
        @include('partials.errors')
    </form>
   
    
    
    
@endsection
    