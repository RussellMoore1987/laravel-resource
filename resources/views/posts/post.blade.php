@extends('layouts.htmlwrapper')

@section('title', $post['title'])

@section('body')
    <div>
        <h2>{{ $post['title'] }}</h2>
        <p>{{ $post['content'] }}</p>
    </div> 
    <br>
    <br>
    <br>
    <a href="{{ route('post.posts') }}">---Back to posts---</a>
@endsection