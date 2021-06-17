@extends('layouts.htmlwrapper')

@section('title', $post->slug)

@section('body')
    <div>
        <h2>{{ $post->slug }}</h2>
        <p>{{ $post->body }}</p>
    </div> 
    <br>
    <br>
    <br>
    <a href="{{ route('post.postsdb') }}">---Back to postsdb---</a>
@endsection