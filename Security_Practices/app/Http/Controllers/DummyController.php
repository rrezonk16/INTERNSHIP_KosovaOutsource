<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DummyController extends Controller
{
    public function search(Request $request)
    {
        $dummieName = $request->input('name');
        $dummies = DB::select("SELECT * FROM dummies WHERE name = '$dummieName'");

        return $dummies;
    }

    public function safeSearch(Request $request)
    {
        $dummieName = $request->input('name');
        $dummies = DB::table('dummies')->where('name', $dummieName)->get();

        return $dummies;
    }
}
