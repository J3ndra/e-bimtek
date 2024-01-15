<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Facades\Services\QuizService;

class Quiz implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return QuizService::validation($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kuis telah digunakan.';
    }
}
