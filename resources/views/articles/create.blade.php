@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Buat Artikel Baru</h1>
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Konten</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
