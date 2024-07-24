<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $request->validate([
            'post_text' => 'required|string',
        ]);

        $user = Auth::user();

        $post = Post::create([
            'user_id' => $user->id,
            'post_text' => $request->post_text,
            'likes' => 0, // Default value
        ]);

        return response()->json(['post' => $post], 201);
    }
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'post_text' => 'required|string',
        ]);

        $post = Post::findOrFail($id);

        $this->authorize('update', $post);

        $post->update([
            'post_text' => $request->post_text,
        ]);

        return response()->json(['post' => $post], 200);
    }
}
