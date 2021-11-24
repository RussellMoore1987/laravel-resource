@extends('layouts.htmlwrapper')

@section('title', 'Posts')

@section('body')
    {{-- {{ removes html special characters }} --}}
    <a href="{{ route('post.create') }}">---Add New Post---</a>
    @forelse ($posts as $post)
        @include('posts.partials.post')
    @empty
       <div>No posts are available!!!</div>
    @endforelse
    <a href="{{ route('post.create') }}">---Add New Post---</a>
@endsection