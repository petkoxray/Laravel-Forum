<?php

namespace App\Utils\Spam;

use App\Utils\Spam\Rules\KeyHeldDown;
use App\Utils\Spam\Rules\InvalidKeywords;

/**
 * Custom example Class for managing Spam
 * Just for test (nothing special).
 */
class SpamService
{
    /**
     * All registered inspections.
     *
     * @var array
     */
    protected $inspections = [
        InvalidKeywords::class,
        KeyHeldDown::class
    ];

    /**
     * Detect spam.
     *
     * @param  string $body
     * @return bool
     */
    public function detect($body)
    {
        foreach ($this->inspections as $inspection) {
            app($inspection)->detect($body);
        }

        return false;
    }
}
