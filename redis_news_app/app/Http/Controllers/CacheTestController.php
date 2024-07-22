<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Article;

class CacheTestController extends Controller
{
    public function testCache()
    {
        $cacheKey = 'articles_list';

        $articles = Cache::remember($cacheKey, 60, function () {
            return Article::latest()->take(10)->get();
        });

        return response()->json($articles);
    }
}
