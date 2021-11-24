@extends('layouts.htmlwrapper')

@section('title', $post->slug)

@section('body')
    @if (Str::length($post->slug) > 15)
        <h3>!!!Big Title!!!</h3>  
    @endif

    <div>
        <h2>{{ $post->slug }}</h2>
        <p>{{ $post->body }}</p>
    </div> 
    <br>
    <br>
    <br>
    <a href="{{ route('post.posts') . '#' . $post->slug }}">---Back to postsdb---</a>
@endsection