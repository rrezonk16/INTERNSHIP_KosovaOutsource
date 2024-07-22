<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\Models\Article;
use Illuminate\Http\Request;

class NewsController extends Controller
{
  
    public function getLatestNews()
    {
        $cacheKey = 'latest_news';

        $articles = Cache::remember($cacheKey, 60, function () {
            return Article::latest()->take(10)->get();
        });

        return response()->json($articles);
    }
     
    public function createArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::create($validated);

        Cache::forget('latest_news');

        return response()->json(['success' => 'Article created', 'article' => $article], 201);
    }

    public function updateArticle($id, Request $request)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $article->update($validated);

        Cache::forget('latest_news');

        return response()->json(['success' => 'Article updated', 'article' => $article]);
    }


    public function deleteArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        Cache::forget('latest_news');

        return response()->json(['success' => 'Article deleted']);
    }
}
