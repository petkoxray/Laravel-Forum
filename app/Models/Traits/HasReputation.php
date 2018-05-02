<?php

namespace App\Models\Traits;

trait HasReputation
{
    /**
     * Award reputation points to the model.
     *
     * @param  int $points
     */
    public function gainReputation($points)
    {
        $this->increment('reputation', $points);
    }

    /**
     * Reduce reputation points for the model.
     *
     * @param  int $points
     */
    public function loseReputation($points)
    {
        $this->decrement('reputation', $points);
    }
}
