@extends('layouts.layout-projects')

@section('content')
    <h1 class="is-size-1">Products</h1>
    
    @if ( session('message') )
    
      <p>{{ session('message') }}</p>
    @endif
    
      
    
        @foreach($products->chunk(3) as $chunk)
        <div class="tile is-ancestor">
             
          @foreach($chunk as $product)
          
         
              <div class="tile is-parent ">
                  <div class="tile is-child box notification is-info">
                      
                        <p class="is-size-3">{{$product->title}}</p>
                      <div class="content is-size-5">
                        <img src="{{$product->image}}"></img>
                      </div>
                      <a class="button is-primary" href="/projects/{{$product->id}}/edit">
                        Edit
                      </a>
                      <a class="button is-danger" href="/projects/{{$product->id}}/edit">
                        Delete
                      </a>
                      <a class="button is-success" href="/projects/{{$product->id}}">
                        Open
                      </a>
                      
                  </div>
              </div> 
            
            
          @endforeach
          </div>
        @endforeach
    
    <a class="button is-info" href="/">
      Home
    </a>
    <a class="button is-success" href="/projects/create">
      Create Project
    </a>
@endsection
    