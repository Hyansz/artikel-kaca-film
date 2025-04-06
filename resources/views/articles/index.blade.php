@extends('layouts.app')

@section('nav')
    <div class="text-white text-center" style="background-image: url('{{ asset('images/hero.jpg') }}'); background-size: cover; background-position: center; position: relative;">
        <div class="overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.6);"></div>
        <div class="container position-relative py-3 d-flex justify-content-between">
            <div>
                <a href="{{ route('articles.index') }}" class="text-white link-underline link-underline-opacity-0 fw-bold fs-4">KacaFilm</a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('articles.index') }}" class="text-white link-underline link-underline-opacity-0">Home</a>
                <a href="{{ route('articles.index') }}" class="text-white link-underline link-underline-opacity-0">About</a>
                <a href="{{ route('articles.index') }}" class="text-white link-underline link-underline-opacity-0">Artikel</a>
                <a href="{{ route('articles.index') }}" class="text-white link-underline link-underline-opacity-0">Contact Us</a>
            </div>
        </div>
        <div class="container position-relative py-5">
            <h1 class="display-4 fw-bold">News Feed</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">News Feed</li>
                </ol>
            </nav>
        </div>
    </div>
@endsection

@section('content')

{{-- Main Content --}}
<div class="container py-5">
    <h1 class="mb-4">Daftar Artikel</h1>
    <a href="{{ route('articles.create') }}" class="btn btn-primary w-100 mb-4">Buat Artikel Baru</a>
    
    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        {{-- Artikel --}}
        <div class="col-md-8">
            <div class="row">
                @foreach ($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="position-relative">
                            @if ($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" class="card-img-top" alt="{{ $article->title }}">
                            @endif
                            <div class="position-absolute bottom-0 end-0 bg-danger text-white px-3 py-1">
                                {{ date('d M Y', strtotime($article->created_at)) }}
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <div class="d-flex align-items-center mb-2">
                                <span class="me-2 text-muted"><i class="bi bi-person"></i> Admin</span>
                                <span class="text-muted"><i class="bi bi-folder"></i> Events</span>
                            </div>
                            <p class="card-text text-truncate" style="max-width: 100%;">{{ Str::limit($article->content, 100) }}</p>
                            <a href="{{ route('articles.show', $article->id) }}" class="text-decoration-none text-warning fw-bold">Read More →</a>
                            <div class="mt-3">
                                <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-md-4">
            <div class="card p-3">
                <form action="{{ route('articles.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari artikel..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
            <div class="card p-3">
                <h5>Postingan Terkini</h5>
                @foreach ($recentArticles as $recent)
                    <div class="d-flex mb-2">
                        @if ($recent->thumbnail)
                            <img src="{{ asset('storage/' . $recent->thumbnail) }}" width="50" class="me-2">
                        @endif
                        <div>
                            <a href="{{ route('articles.show', $recent->id) }}" class="text-dark d-block">{{ $recent->title }}</a>
                            <small class="text-muted">{{ date('d M Y', strtotime($recent->created_at)) }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
