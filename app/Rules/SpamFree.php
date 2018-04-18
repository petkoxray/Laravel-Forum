<?php

namespace App\Rules;

use App\Utils\Spam\SpamService;
use Exception;
use Illuminate\Contracts\Validation\Rule;

class SpamFree implements Rule
{
    /**
     * @var SpamService
     */
    private $spamService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(SpamService $spamService)
    {
        $this->spamService = $spamService;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            return ! $this->spamService->detect($value);
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute contains spam';
    }
}
