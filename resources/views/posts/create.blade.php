@extends('layouts.htmlwrapper')

@section('title', "Make New Post")

@section('body')
    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <div>
            <label for="slug_name">Slug-Name</label>
            <input type="text" name="slug" id="slug_name">
        </div>

        <div>
            <label for="published_at">Published Date</label>
            <input type="date" name="published_at" id="published_at">
        </div>

        <div>
            <label for="body"></label>
            <textarea name="body" id="body" cols="30" rows="10"></textarea>
        </div>

        <div>
            <button type="submit">Save</button>
        </div>
    </form>
@endsection