@extends('layouts.htmlwrapper')

@section('title', 'Posts-db')

@section('body')
    {{-- {{ removes html special characters }} --}}
    @forelse ($posts as $post)
        @include('posts.partials.post')
    @empty
       <div>No posts are available!!!</div>
    @endforelse
@endsection