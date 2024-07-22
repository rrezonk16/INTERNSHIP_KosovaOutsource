<?php

namespace App\Policies;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;


    public function delete(User $user, Thread $thread)
    {
//Fshije Thread nese je owner i thread ose admin
        return $user->id === $thread->user_id || $user->hasRole('admin');
    }
}
