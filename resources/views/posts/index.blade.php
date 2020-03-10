@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if(count($posts)>0)
        @foreach($posts as $post)
        

        <div class="list-group">
        <a href="/posts/{{$post->id}}" class="list-group-item list-group-item-action ">
              <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{$post->title}}</h5>
              <small>{{$post->created_at}}</small>
              
              </div>
            <p class="mb-1">{!!$post->body!!}</p>
            <small>{{$post->user->name}}</small><br>
            <small> Category: {{$post->category->name}}</small>
            </a>
            </div>
              @endforeach
              {{$posts->links()}}
              @else 
              <p> No posts found </p>
        @endif
@endsection




 







