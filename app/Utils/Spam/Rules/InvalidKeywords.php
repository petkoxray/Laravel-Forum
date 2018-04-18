<?php

namespace App\Utils\Spam\Rules;

use Exception;

class InvalidKeywords implements SpamRulesInterface
{
    /**
     * All registered invalid keywords.
     *
     * @var array
     */
    protected $keywords = [
        'yahoo customer support'
    ];

    /**
     * Detect spam.
     *
     * @param  string $body
     * @throws \Exception
     */
    public function detect(string $body)
    {
        foreach ($this->keywords as $keyword) {
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }
    }
}