<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /**
     * Don't auto apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Fetch the associated subject for the activity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function subject()
    {
        return $this->morphTo();
    }

    /**
     * Fetch User activity feed.
     *
     * @param User $user
     * @param int $take
     */
    public static function feed(User $user, int $take = 50)
    {
        return $user->activity()
            ->latest()
            ->with('subject')
            ->get()
            ->take($take)
            ->groupBy(function ($activity) {
                return $activity->created_at->format('Y-m-d');
            });
    }
}
