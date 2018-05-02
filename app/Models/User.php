<?php

namespace App\Models;

use App\Models\Traits\HasReputation;
use App\Models\Traits\HasRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRole, HasReputation;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email',
        'confirmation_token'
    ];

    /**
     * Get the route key name for Laravel.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    /**
     * Get all user threads.
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    /**
     * Return user activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    /**
     * Return user last reply.
     *
     * @return \Illuminate\Database\Query\Builder|static
     */
    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    /**
     * Get the path to the user's avatar.
     *
     * @param  string $avatar
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        return $avatar ? asset('storage/'.$avatar) : asset('images/avatars/default.png');
    }

    /**
     *Confirm user account.
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;

        $this->save();
    }
}
