<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'description' => $request->description,
            'likes' => 0, 
        ]);

        return response()->json($post, 201);
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id !== Auth::id() && !Gate::allows('delete-posts')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
