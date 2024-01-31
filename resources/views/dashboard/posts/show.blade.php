@extends('dashboard.layouts.main')
@section('container')
<div class="container position-relative">
  <div class="row justify-content-center mb-5">
      <div class="col-lg-8">
          <h1 class="mb-3">{{ $post->title }}</h1>
          <a href="/dashboard/posts" class="btn btn-success mb-3"><i class="bi bi-arrow-left"></i> Back to all my posts</a>
          <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mb-3"><i class="bi bi-pencil-square"></i> Edit</a>
          <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure ?')"><i class="bi bi-x-circle"></i> Delete</button>
          </form>
          @if ($post->image)
            <div style="max-height: 350px; overflow:hidden;">
              <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid" alt="{{ $post->category->name }}">
            </div>
          @else
            <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}" class="img-fluid" alt="{{ $post->category->name }}">
          @endif
          <article class="my-3 fs-5">
              {!! $post->body !!}
          </article>
      </div>
  </div>
</div>
  @endsection