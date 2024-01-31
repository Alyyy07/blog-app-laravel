@extends('layouts.main')
@section('container')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-9">
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p>By. <a href="/blogs?author={{ $post->author->username }}" class="text-decoration-none">{{ $post->author->name }}</a> in <a href="/blogs?category={{ $post->category->slug }}" class="text-decoration-none">{{ $post->category->name }} </a></p>
            @if ($post->image)
                <img src="{{ asset('storage/' . $post->image) }} " style="max-height: 450px" alt="{{ $post->category->name }}">
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
                @endif
            <article class="my-3 fs-5">
                {!! $post->body !!}
            </article>
            <a href="/blogs" class="d-block mt-3">Back to Posts</a>
        </div>
    </div>
</div>
@endsection