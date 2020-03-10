@extends('layouts.app')

@section('content')
    <h1>Create Posts</h1>
    <form method="post" action="{{ route('posts.store') }}">
            <div class="form-group">
                @csrf            
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Title"/>
            </div>
            <label >Category </label>
            <select name ="category_id" class="browser-default custom-select">
                    <option name="category_id" selected>Categories</option>
                    @foreach($categories as $category)
            <option value='{{$category->id}}'>{!!$category->name!!}</option>
                    @endforeach
                  </select>



            <div class="form-group">
                <label for="body">Body</label>
                <textarea id="article-ckeditor" class="form-control" name="body" cols="30" rows="10" placeholder="Body Text"></textarea>
            </div>
    
            <button type="submit" class="btn btn-primary">Submit</button>
     </form>
  
@endsection
