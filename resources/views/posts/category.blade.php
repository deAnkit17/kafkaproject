






@extends('layouts.app')

@section('content')


<h1>POSTS</h1>

    @if(count($posts)>0)
        @foreach($posts as $post)
        

        <div class="list-group">
        <a href="/posts/{{$post->id}}" class="list-group-item list-group-item-action ">
              <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{$post->title}}</h5>
              <p>{{$post->created_at}}</p>
              
              </div>
            <p class="mb-1">{!!$post->body!!}</p>
   
            
            </a>
            </div>
              @endforeach
              
              
        @endif
@endsection



