<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index(Request $request, $courseId)
    {
        $user = Auth::user();

        $threads = Thread::where('course_id', $courseId)->get();

        foreach ($threads as $thread) {
            $this->authorize('view', $thread);
        }

        return response()->json($threads);
    }
    public function store(Request $request)
    {
        $course = Course::findOrFail($request->course_id);

        $this->authorize('create', $course);

        $thread = Thread::create([
            'course_id' => $request->course_id,
            'posted_by' => Auth::id(),
            'text' => $request->text,
        ]);

        return response()->json($thread, 201);
    }

    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update($request->only('text'));

        return response()->json($thread);
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);

        $thread->delete();

        return response()->json(null, 204);
    }
}
