@extends('layouts.htmlwrapper')

@section('title', 'Posts')

@section('body')
    {{-- {{ removes html special characters }} --}}
    @foreach ($posts as $id => $post)
        <div>
            <h2><a href="{{ route('post.post', $id) }}">{{ $post['title'] }}</a></h2>
            <p>{{ $post['content'] }}</p>
        </div>    
    @endforeach
@endsection