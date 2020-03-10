@extends('layouts.app')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('posts.update',$post->id) }}" method="POST">
        <div class="form-group">
        @method('PUT')
        @csrf          
            <label for="title">Title</label>
            <input type="text" class="form-control" value="{{ $post->title }}" name="title" placeholder="Title"/>
        </div>

        <select  name="category_id">
                @foreach ($categories as $key=>$value)
                      <option value="{{$key}}" {{($key == $post->category_id) ? "selected" : ""}}>{{$value}}</option>
                @endforeach  
           </select>


        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="article-ckeditor" class="form-control" name="body" cols="30" rows="10" placeholder="Detail">{{ $post->body }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
 </form>
  
@endsection