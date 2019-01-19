<?php

namespace App\Observers;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function creating(User $user)
    {
        //
    }

    public function updating(User $user)
    {
        //
    }

    // public function deleted(User $user)
    // {
    //     $topic_ids = $user->topics->pluck('id')->all();
    //     \DB::table('topics')->where('user_id', '=', $user->id)->delete();
    //     \DB::table('replies')
    //         ->whereIn('topic_id', $topic_ids)
    //         ->orWhere('user_id', '=', $user->id)
    //         ->delete();
    // }

}