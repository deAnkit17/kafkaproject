@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Back</a>
    <h1>{{$post->title}}</h1>
    
    <div>
        {!!$post->body!!} 
    </div>
    
   
    <hr>
    <small> Written on {{$post->created_at}} by {{$post->user->name}}</small><br>
    <small> Posted In: {{$post->category->name}}</small>
    <hr>


@if(!Auth::guest())
    @if(Auth::user()->id == $post->user_id)

<form action="{{ route('posts.destroy',$post->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <!-- edit button -->
            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info">Edit</a>
        <!-- delete button -->
            <button type="submit" class="btn btn-danger float-right">Delete</button>
    </form>
    @endif
    @endif
@endsection
