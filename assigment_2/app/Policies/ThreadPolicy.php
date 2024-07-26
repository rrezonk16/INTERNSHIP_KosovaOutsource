<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Enrollments;
use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;
    public function view(User $user, Thread $thread)
    {
        return Enrollments::where('student_id', $user->id)
            ->where('course_id', $thread->course_id)
            ->exists();
    }

    public function create(User $user, Course $course)
    {
        return $user->hasRole('instructor') && $user->id === $course->instructor_id;
    }

  
    public function update(User $user, Thread $thread)
    {
        return $user->hasRole('instructor') && $user->id === $thread->course->instructor_id;
    }


    public function delete(User $user, Thread $thread)
    {
        return $user->hasRole('instructor') && $user->id === $thread->course->instructor_id;
    }
}
