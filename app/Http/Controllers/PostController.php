<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with(['categories','user'])->get();
        return view('Dashboard.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('Dashboard.posts.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if ($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('posts', $filename,'public');

        else
            $filename = "posts/dummy.jpg";
        $post = [
            'title' =>$request->title,
            'content' =>$request->description,
            'user_id' =>1,
            'slug' => $request->title,
            'thumbnail' => $filename,

        ];
        $post = Post::create($post);

        if ($post){

            $post->categories()->attach($request->categories);
            return redirect()->route('posts.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['post'] = Post::with(['categories','user'])->where('id',$id)->first();

        return view('Dashboard.posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['post'] = Post::with(['categories','user'])->where('id',$id)->first();
        $data['categories'] = Category::all();
        return view('Dashboard.posts.edit',$data);
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
        $post = Post::find($id);

        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if ($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('posts', $filename,'public');

        else
            $filename = $post->thumbnail;

        $post->title = $request->title;
        $post->content = $request->description;
        $post->thumbnail = $filename;

        if ($post->save()){
            $post->categories()->sync($request->categories);
            return redirect()->route('posts.index');
        }
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
        $post->categories()->detach();
        $post->delete();
        return redirect()->route('posts.index');
    }
}
