<div id="{{ $post->slug }}">
    <h2><a href="{{ route('post.postdb', $post->slug) }}">{{ $post->slug }}</a></h2>
    <p>{{ Str::of($post->body)->limit(35) }}</p>
</div> 