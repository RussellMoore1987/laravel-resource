@extends('layouts.htmlwrapper')

@section('title', 'Posts-db')

@section('body')
    {{-- {{ removes html special characters }} --}}
    @foreach ($posts as $post)
        <div>
            <h2><a href="{{ route('post.postdb', $post->slug) }}">{{ $post->slug }}</a></h2>
            <p>{{ Str::of($post->body)->limit(35) }}</p>
        </div>    
    @endforeach
@endsection