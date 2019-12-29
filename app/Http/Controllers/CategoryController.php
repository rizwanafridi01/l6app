<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cat = Category::where('id','<>','parent_id')->get();
        return  view('Dashboard.categories.create',compact('parent_cat'));
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
//        dd($request->parent_id);
        $category = new Category();
        $category->title = $request->title;
        $category->content = $request->description;
        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));
        if ($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('images', $filename,'public');

        else
            $filename = null;
        $category->thumbnail = $filename;
        $category->parent_id = $request->parent_id;
        $save = $category->save();
        if ($save){
            return  redirect()->route('categories.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {

        return view('Dashboard.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
//        dd($category->parent);
        $categories = Category::where('id','<>',$category->id)->get();
        return view('Dashboard.categories.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function update(Request $request, Category $category)
    {

        $category->title = $request->title;
        $category->content = $request->description;
        $filename = sprintf('thumbnail_%s.jpg',random_int(1,1000));

//        dd($filename);
        if ($request->hasFile('thumbnail'))
            $filename = $request->file('thumbnail')->storeAs('images', $filename,'public');

        else
            $filename = $category->thumbnail;

        $category->thumbnail = $filename;
        $category->parent_id = $request->parent_id;
        $save = $category->save();
        if ($save){
            return  redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return  redirect()->route('categories.index');

    }
}
