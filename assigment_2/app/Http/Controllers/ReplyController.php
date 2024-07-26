<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {

        $request->validate([
            'thread_id' => 'required|exists:threads,id',
            'text' => 'required|string',
        ]);

        $reply = Reply::create([
            'user_id' => Auth::id(),
            'thread_id' => $request->thread_id,
            'text' => $request->text,
        ]);

        return response()->json($reply, 201);
    }

    public function update(Request $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $request->validate([
            'text' => 'required|string',
        ]);

        $reply->update($request->only('text'));

        return response()->json($reply);
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->delete();

        return response()->json(null, 204);
    }
}
