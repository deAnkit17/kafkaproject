<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use DB;


class PostsController extends Controller
{

      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
       //$posts = Post::all();
       // $posts= post::orderBy('title','asc')->get();
       // return Post:: where('title','Post Two')->get();
       // $posts = DB:: select('SELECT * FROM posts');
       //$posts= post::orderBy('title','desc')->take(1)->get();
       $posts= post::orderBy('created_at','desc')->paginate(10);//after 10 posts pagination happens
      //  $posts= post::orderBy('title','desc')->get();
        return view('posts.index')->with('posts',$posts);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Category::all();
        return view('posts.create')->withCategories($categories);
    }

    public function category($cat_id){

        $categories = Category::all();
        
        
        $posts = DB::table('posts')
                ->join('categories','posts.category_id','=','categories.id')
                ->select('posts.*','categories.*')
                ->where(['categories.id'=> $cat_id])
                ->get();
              //  return $post;
               // exit();
            
         return view('posts.category')->with('posts',$posts)->with('categories',$categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=> 'required',
            'body'=> 'required',
            'category_id'=>'required|integer'
        ]);
        //create post

        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id= $request->category_id;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with ('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $post = Post::find($id);
        $categories = Category::all();
        $cats = array();
        foreach ($categories as $category){
            $cats[$category->id] = $category->name;
        }

        //check for correct user
        if(auth()->user()->id !== $post->user_id){
        return redirect('/posts')->with ('error','Unauthorized to edit');
        }

        return view('posts.edit')->with('post',$post)->with('categories',$cats);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=> 'required',
            'category_id'=>'required|integer',
            'body'=> 'required'
        ]);
        //create post

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->category_id= $request->category_id;
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with ('error','Unauthorized to delete');
            }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted');

    }
}
