<?php

namespace App\Widgets;

use App\Models\Thread;
use Illuminate\Support\Facades\Redis;

class Trending
{
    private $cacheKey = 'trending_threads';

    public function get()
    {
        return array_map('json_decode', Redis::zrevrange($this->getcacheKey(), 0, 4));
    }

    public function push(Thread $thread)
    {
        Redis::zincrby($this->getCacheKey(), 1, json_encode([
            'title' => $thread->title,
            'path' => $thread->path()
        ]));
    }

    public function getCacheKey()
    {
        return $this->cacheKey;
    }

    public function reset()
    {
        Redis::del($this->getCacheKey());
    }
}
