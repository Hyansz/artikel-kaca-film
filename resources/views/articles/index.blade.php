@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('articles.create') }}" class="btn btn-primary w-100 mb-4">Buat Artikel Baru</a>
    <div class="row">
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-4">
            {{-- <div class="card p-3 mb-4">
                <h5>Cari</h5>
                <form action="{{ route('articles.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari artikel...">
                        <button class="btn btn-danger" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                </form>
            </div> --}}
            {{-- <div class="card p-3 mb-4">
                <h5>Kategori</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-dark">All <span class="badge bg-secondary">7</span></a></li>
                    <li><a href="#" class="text-dark">News <span class="badge bg-secondary">4</span></a></li>
                    <li><a href="#" class="text-dark">Event <span class="badge bg-secondary">2</span></a></li>
                    <li><a href="#" class="text-dark">Promo <span class="badge bg-secondary">0</span></a></li>
                    <li><a href="#" class="text-dark">Tips <span class="badge bg-secondary">1</span></a></li>
                </ul>
            </div> --}}
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
