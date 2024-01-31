@extends('dashboard.layouts.main')
@section('container')
<div class="mt-2 border-bottom">
    <h1 class="h2">{{ $title }}</h1>
</div>
<div class="col-lg-8">
    <form method="POST" action="/dashboard/categories" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" class="form-control @error('name') is-invalid
                @enderror" value="{{ old('name') }}" required autofocus id="name" name="name">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    
                @enderror
    </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control @error('slug') is-invalid
            @enderror" id="slug" name="slug" value="{{ old('slug') }}" required>
            @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    
                @enderror
    </div>

        <div class="mb-3">
            <label for="image" class="form-label">Category Image</label>
            <img class="img-preview img-fluid mb-3 col-sm-5" style="overflow:hidden;">
            <input type="file" class="form-control @error('image') is-invalid
            @enderror" id="image" name="image" onchange="previewImage()">
            @error('image')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    
                @enderror
        </div>
    <button type="submit" class="btn btn-primary">Create Category</button>
</form>
</div>
<script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('keyup', function() {
        if(name.value.length == 0) slug.value = '';
            fetch('/dashboard/categories/checkSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    });

    // fungsi untuk menghilangkan tombol upload gambar ( selain perubahan yang dilakukan di css)
    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>

@endsection