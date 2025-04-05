<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        $recentArticles = Article::latest()->take(5)->get();
        
        return view('articles.index', compact('articles', 'recentArticles'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $thumbnailPath = $request->file('thumbnail') ? $request->file('thumbnail')->store('thumbnails', 'public') : null;

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $thumbnailPath = $article->thumbnail;
        
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article->update([
            'title' => $request->title,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus');
    }
}
