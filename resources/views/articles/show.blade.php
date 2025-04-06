@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>{{ $article->title }}</h1>
        <a href="{{ route('articles.index') }}" class="btn btn-primary">Kembali</a>
    </div>
    @if ($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" width="300" class="mb-3">
    @endif
    <p>{{ $article->content }}</p>
</div>
@endsection
