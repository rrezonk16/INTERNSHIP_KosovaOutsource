<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AnalyticsController extends Controller
{
    public function trackPageView($page)
    {
        Redis::incr("page_views:$page");

        return response()->json(['success' => 'Page view tracked']);
    }

    public function getPageViews($page)
    {
        $views = Redis::get("page_views:$page");

        return response()->json(['page' => $page, 'views' => $views]);
    }
}
