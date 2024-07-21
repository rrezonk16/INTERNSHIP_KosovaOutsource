<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redis;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function handleRequest(Request $request)
    {
        $userIp = $request->ip();
        $key = "rate_limit:$userIp";
        $current = Redis::incr($key);

        if ($current == 1) {
            Redis::expire($key, 60);
        }

        if ($current > 100) {
            return response()->json(['error' => 'Too many requests'], 429);
        }

        // Handle the request
        return response()->json(['success' => 'Request accepted']);
    }
}