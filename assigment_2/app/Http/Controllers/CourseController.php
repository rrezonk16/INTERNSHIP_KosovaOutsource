<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Course::class);

        $course = Course::create([
            'name' => $request->name,
            'about' => $request->about,
            'instructor_id' => Auth::id(),
        ]);

        return response()->json($course, 201);
    }

    public function update(Request $request, Course $course)
    {
        $this->authorize('update', $course);

        $course->update($request->only('name', 'about'));

        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $this->authorize('delete', $course);

        $course->delete();

        return response()->json(null, 204);
    }
}
