<?php

namespace App\Utils\Spam\Rules;

interface SpamRulesInterface
{
    public function detect(string $body);
}