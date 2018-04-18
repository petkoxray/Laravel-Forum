<?php

namespace App\Utils\Spam\Rules;

use Exception;

class KeyHeldDown implements SpamRulesInterface
{
    /**
     * Detect spam.
     *
     * @param  string $body
     * @throws \Exception
     */
    public function detect(string $body)
    {
        if (preg_match('/(.)\\1{4,}/', $body)) {
            throw new Exception('Your reply contains spam.');
        }
    }
}