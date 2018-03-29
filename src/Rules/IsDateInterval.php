<?php

namespace Stylers\Laratask\Rules;

use Illuminate\Contracts\Validation\Rule;
use Stylers\Laratask\Support\DateInterval;

class IsDateInterval implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        try {
            new DateInterval($value);
            return true;
        } catch (\Exception $exception) {
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
        return trans('validation.is_dateinterval', ['attribute' => ':attribute']);
    }
}