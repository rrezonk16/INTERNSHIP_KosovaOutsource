<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  
    public function showRole(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'role' => $user->role->name,
            ], 200);
        } else {
            return response()->json([
                'error' => 'Unauthorized',
            ], 401);
        }
    }
}
