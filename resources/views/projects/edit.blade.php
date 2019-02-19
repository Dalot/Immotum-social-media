@extends('layouts.layout-projects')

@section('content')
    <h1 class="title">Edit Project</h1>
    
    <form method="POST" action="/projects/{{ $project->id }}">
        
        
        @method('PATCH')
        @csrf
        
        <div class="field">
            <label for="title" class="label">Title</label>
            
             <div class="control">
            <input type="text" name="title" class="input" placeholder="Title" value="{{ $project->title }}"/>
        </div>
        </div>
        
       
        
        <div class="field">
            <label for="description" class="label">Description</label>
            
            <div class="control">
                <textarea name="description" class="textarea" id="" cols="30" rows="10">{{ $project->description }}</textarea>
            </div>
        </div>
        
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
            </div>
        </div>
    </form>
    
    <form method="POST" action="/projects/ {{ $project->id }}">
        @method("DELETE")
        @csrf
        
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-danger">Delete</button>
            </div>
        </div>
        
    </form>
@endsection