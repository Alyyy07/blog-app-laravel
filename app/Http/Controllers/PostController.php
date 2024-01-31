<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug',request('category'));
            $title = " in Category : $category->name";
        }elseif(request('author')){
            $author = User::firstWhere('username',request('author'));
            $title = " by Author : $author->name";
        }
        return view('posts', [
            'title' => "All Post".$title,
            "active" => "blog",
            // 'posts'=> Post::all(),
            'posts' => Post::latest()->search(request(['search','category','author']))->paginate(7)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('post',
        [
            'title' => 'Single Post',
            "active"=>'blog',
            'post' => $post,
        ]);
    }
}
