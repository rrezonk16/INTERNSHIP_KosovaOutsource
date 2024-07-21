<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
    public function index()
    {
        Redis::set('user:1:firstname', 'Mike');
        Redis::set('user:2:firstname', 'Filan');
        Redis::set('user:3:firstname', 'Rrezon');

        for ($i = 1; $i <= 3; $i++) {
            echo Redis::get('user:' . $i . ':firstname') . '<br>';
        }
    }
}
