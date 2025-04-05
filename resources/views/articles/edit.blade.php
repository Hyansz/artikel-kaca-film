@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Artikel</h1>
    <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $article->content }}</textarea>
        </div>
        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            @if ($article->thumbnail)
                <img src="{{ asset('storage/' . $article->thumbnail) }}" width="150" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
    </form>
</div>
@endsection
