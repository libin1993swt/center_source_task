<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Events\CategoryUpdated;
use Illuminate\Foundation\Events\Dispatchable;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->all();
        if(isset($data['parent_id'])) {
            $parent = Category::with('recursiveParents')->where('id',$data['parent_id'])->first();
            $res = $this->parentCategories($test = array(),$parent);
            $res = array_reverse($res);
            $res = implode('/',$res);
            $urlString = '/'.$res.'/'.$data['title'];
            $data['url'] = str_replace(' ','-',$urlString); 
        } else {
            $data['url'] = str_replace(' ','-',$data['title']);
        }
        Category::create($data);
        return \Redirect::to('category')->with('message', 'Category saved successfully.');
    }

    public function parentCategories($test = array(),$parent) {
        if(isset($parent->title)){
            array_push($test,$parent->title);
        }
        
        if(isset($parent->recursiveParents) && count($parent->recursiveParents) > 0) {
            foreach($parent->recursiveParents as $key => $category) {
                if(isset($category->recursiveParents) && count($category->recursiveParents) > 0) {
                    return $this->parentCategories($test,$category);
                } else if(isset($category->title)) {
                    return $this->parentCategories($test,$category);
                } else {
                    return $test;
                }
            }
        } else {
            return $test;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::latest()->get();
       
        return view('category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->all();
        $category->parent_id = $data['parent_id'];
        $category->title = $data['title'];
            $parent = Category::with('recursiveParents','recursiveChildren')->where('id',$data['parent_id'])->first();
            $res = $this->parentCategories($test = array(),$parent);
            $res = array_reverse($res);
            $res = implode('/',$res);
            $urlString = '/'.$res.'/'.$data['title'];
        $category->url = str_replace(' ','-',$urlString);
        $category->save();

        event(new CategoryUpdated($category));
        return \Redirect::to('category')->with('message', 'Category saved successfully.');
        // CategoryUpdated::dispatch($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
