<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('dashboard.posts.index', [
            'posts' => Post::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.posts.create',['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255|min:3',
            'slug' => 'required|unique:posts',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required',
            'category_id' => 'required',
        ]);

        if($request->hasFile('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = substr($request->body, 0, 200);

        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories'=>Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $rules = ([
            'title' => 'required|max:255|min:3',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if($request->hasFile('image')){
            if($request->oldImage){
                unlink('storage/'.$request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = substr($request->body, 0, 200);

        Post::where('id',$post->id)->update($validatedData);

        return redirect('/dashboard/posts')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if($post->image){
            unlink('storage/'.$post->image);
        }
        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('success', 'Post has been deleted!');
    }
    public function checkSlug(){
        $slug = SlugService::createSlug(Post::class, 'slug', request()->title);
        return response()->json(['slug'=>$slug]);
    }
}
