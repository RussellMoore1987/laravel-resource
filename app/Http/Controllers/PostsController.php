<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController extends Controller
{
    public function show($slug)
    {
        return view('posts.postdb', ['post' => Post::where('slug', $slug)->firstOrFail()]);
    }

    public function index()
    {
        return view('posts.postsdb', ['posts' => Post::all()]);
    }




















 




    // or
    // public function show($slug)
    // {
    //     $post = Post::where('slug', $slug)->firstOrFail();

    //     return view('posts.postdb', ['post' => $post]);
    // }

    // public function index()
    // {
    //     $posts = Post::all();

    //     return view('posts.postsdb', ['posts' => $posts]);
    // }
}
