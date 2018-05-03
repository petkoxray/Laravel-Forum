<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Filters\ThreadFilters;
use App\Events\ThreadHasNewReply;
use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Cviebrock\EloquentSluggable\Sluggable;

class Thread extends Model
{
    use RecordsActivity, Sluggable, Searchable;

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * @var array
     */
    protected $with = ['creator', 'channel'];

    protected $append = ['isSubscribedTo'];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function (Builder $builder) {
            $builder->withCount('replies');
        });

        static::deleting(function (Thread $thread) {
            $thread->replies->each->delete();

            $thread->creator->loseReputation(config('forum.reputation.thread_published'));
        });

        static::created(function (Thread $thread) {
            $thread->creator->gainReputation(config('forum.reputation.thread_published'));
        });
    }

    /**
     * Get a string path for the thread.
     *
     * @return string
     */
    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->slug}";
    }

    /**
     * A Thread may have many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Get the creator of the Thread.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A Thread have a Channel.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id');
    }

    /**
     * A thread can have a best reply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bestReply()
    {
        return $this->hasOne(Reply::class, 'thread_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Access the body attribute.
     *
     * @param  string $body
     * @return string
     */
    public function getBodyAttribute($body)
    {
        return \Purify::clean($body);
    }

    /**
     * Add a reply to the thread.
     *
     * @param $reply
     */
    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        event(new ThreadHasNewReply($reply));

        return $reply;
    }

    /**
     * Apply all relevant thread filters.
     *
     * @param  Builder $query
     * @param  ThreadFilters $filters
     * @return Builder
     */
    public function scopeFilter(Builder $query, ThreadFilters $filters)
    {
        return $filters->apply($query);
    }

    /**
     * Subscribe User to thread.
     */
    public function subscribe()
    {
        $this->subscriptions()->create([
            'user_id' => auth()->id()
        ]);
    }

    /**
     * Unsubscribe user from thread.
     */
    public function unsubscribe()
    {
        $this->subscriptions()->where('user_id', auth()->id())->delete();
    }

    /**
     * Get all Thread subscriptions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id', auth()->id())
            ->exists();
    }

    /**
     * Mark a reply as best answer.
     *
     * @param Reply $reply
     */
    public function markBestReply(Reply $reply)
    {
        if ($this->hasBestReply()) {
            $this->removeBestReply();
        }

        $this->update(['best_reply_id' => $reply->id]);

        $reply->owner->gainReputation(config('forum.reputation.best_reply_awarded'));
    }

    /**
     * Reset the best reply record.
     */
    public function removeBestReply()
    {
        $this->bestReply->owner->loseReputation(config('forum.reputation.best_reply_awarded'));

        $this->update(['best_reply_id' => null]);
    }

    /**
     * Determine if the thread has a current best reply.
     *
     * @return bool
     */
    public function hasBestReply()
    {
        return !is_null($this->best_reply_id);
    }

    public function toSearchableArray()
    {
        return $this->toArray();
    }
}
