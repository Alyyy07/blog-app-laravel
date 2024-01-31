@extends('dashboard.layouts.main')
@section('container')
<div class="pt-3 pb-2 mb-3">
    <div class="border-bottom">
        <h1 class="h2">my Posts</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-8 alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      
    @endif

<div class="table-responsive col-lg-8 ">
  <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create New Post</a>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col" class="text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post )
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->category->name }}</td>
            <td class="d-flex gap-1">
                <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info pt-2"><i class="bi bi-eye"></i></a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning pt-2"><i class="bi bi-pencil-square"></i></a>
                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button type="submit" onclick="return confirm('Are you sure ?')" class="badge bg-danger border-0 pt-2"><i class="bi bi-x-circle" ></i></button>
                </form>
                </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
  @endsection