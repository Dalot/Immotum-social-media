@extends('layouts.layout-projects')
@section('content')
    <h1 class="is-size-1">Create a Project</h1>
    
    <form method="POST" action="/projects">
        
        {{ csrf_field() }}
      
        <div class="field">
        
        <label class="is-size-3-tablet">Title</label>
          <div class="control">
            <input class="input is-primary is-large {{ $errors->has('title') ? 'is-danger' : ''  }}" name="title" value="{{ old('title') }}" placeholder="Project Title" type="text">
          </div>
        </div>
        
        <div class="field">
            <label class="is-size-3-tablet">Description</label>
            <div class="control">
                <textarea name="description" placeholder="Project description" class="textarea {{ $errors->has('description') ? 'is-danger' : ''  }}" rows="10">{{ old('description') }}</textarea>
            </div>
        </div>
        
        <div class="field is-grouped">
          <div class="control">
            <button class="button is-link" type="submit">Create Project</button>
          </div>
        </div>
        
        @include('partials.errors')
    </form>
@endsection