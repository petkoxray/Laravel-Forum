<?php

namespace App\Utils\Spam;

use App\Utils\Spam\Rules\InvalidKeywords;
use App\Utils\Spam\Rules\KeyHeldDown;

/**
 * Custom example Class for managing Spam
 * Just for test (nothing special)
 *
 * @package App\Utils\Spam
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