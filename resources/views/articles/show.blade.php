@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $article->title }}</h1>
    @if ($article->thumbnail)
        <img src="{{ asset('storage/' . $article->thumbnail) }}" width="300" class="mb-3">
    @endif
    <p>{{ $article->content }}</p>
    <a href="{{ route('articles.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection
