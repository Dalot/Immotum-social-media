@extends('layouts.layout-projects')

@section('content')
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
@endsection