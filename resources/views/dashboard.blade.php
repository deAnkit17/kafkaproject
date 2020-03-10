@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style = "width = 500px;">Dashboard</div>

                <div class="card-body" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <h3> Your Stories </h3>
                @if (count($posts)>0)    
                    <table class = "table table-striped">
                        <tr>
                            <th>Title </th>
                            <th></th>
                            
                        </tr>
                        @foreach($posts as $post)  
                            <tr>
                            <td><a href = "/posts/{{$post->id}}">{{$post->title}} </td>
                                
                                <td>
                                        <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <!-- edit button -->
                                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-info">Edit</a>
                                                <!-- delete button -->
                                                    <button type="submit" class="btn btn-danger float-right">Delete</button>
                                            </form>
                                </td>
                            </tr>
                        @endforeach
                        </table>  
                  @else    
                        <p>You have no stories</p>
                 @endif  
                 <a href = "/posts/create" class="btn btn-primary">Write your own story</a>      

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
