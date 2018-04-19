<?php

namespace App\Models;

use App\Models\Traits\Favoritable;
use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favoritable, RecordsActivity;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $appends = ['favoritesCount', 'isFavorited'];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['owner', 'favorites'];

    /**
     * A reply belongs to a thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    /**
     * @return string
     */
    public function path()
    {
        return $this->thread->path() . "#reply-{$this->id}";
    }

    /**
     * Determine if the reply was just published a moment ago.
     *
     * @return bool
     */
    public function wasJustPublished()
    {
        return $this->created_at->gt(Carbon::now()->subMinute());
    }

    /**
     * Return all mentioned Users in a Reply
     *
     * @return array
     */
    public function mentionedUsers()
    {
        preg_match_all('/\@([^\s\.]+)/', $this->body, $matches);

        return $matches[1];
    }
}
