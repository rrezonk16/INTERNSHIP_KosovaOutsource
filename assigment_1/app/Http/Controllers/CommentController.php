<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment_text' => 'required|string',
        ]);

        $post = Post::findOrFail($postId);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'comment_text' => $request->comment_text,
            'likes' => 0,
        ]);

        return response()->json(['comment' => $comment], 201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'comment_text' => 'required|string',
        ]);

        $comment = Comment::findOrFail($id);

        $this->authorize('update', $comment);

        $comment->update([
            'comment_text' => $request->comment_text,
        ]);

        return response()->json(['comment' => $comment], 200);
    }
}
