<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Http\Request;

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

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->slug = $request->slug;
        $post->published_at = $request->published_at;
        $post->body = $request->body;
        $post->save();

        // return redirect()->route('post.posts');
        return redirect()->route('post.show', ['slug' => $post->slug]);
        // return redirect()->route('post.show', ['post' => $post->id]);
        // return dd($request, $request->slug, $request->published_at, $request->body);
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
