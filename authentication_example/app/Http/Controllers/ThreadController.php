<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api'); // Ensure that only authenticated users can access these methods
    }

    /**
     * Create a new thread (reply) for a post.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $postId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $postId)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        // Ensure the post exists
        $post = Post::findOrFail($postId);

        // Create the thread (reply)
        $thread = Thread::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'description' => $request->description,
            'likes' => 0, // Default value for likes
        ]);

        return response()->json($thread, 201);
    }

    /**
     * Delete a thread (reply).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $thread = Thread::findOrFail($id);

        // Check if the user is the owner of the thread or an admin
        if ($thread->user_id !== Auth::id() && !Gate::allows('delete-threads')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $thread->delete();

        return response()->json(['message' => 'Thread deleted successfully'], 200);
    }
}
