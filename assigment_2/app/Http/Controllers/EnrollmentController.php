<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;

use App\Models\Enrollments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function enroll(Request $request)
    {
    

        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $existingEnrollment = Enrollments::where('student_id', Auth::id())
            ->where('course_id', $request->course_id)
            ->first();

        if ($existingEnrollment) {
            return response()->json(['error' => 'Already enrolled in this course'], 400);
        }

        $enrollment = Enrollments::create([
            'student_id' => Auth::id(),
            'course_id' => $request->course_id,
        ]);

        return response()->json($enrollment, 201);
    }
}
