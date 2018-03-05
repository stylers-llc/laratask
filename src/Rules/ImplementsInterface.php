<?php

namespace Stylers\Laratask\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImplementsInterface implements Rule
{
    private $interface;

    /**
     * ImplementsInterface constructor.
     * @param $interface
     */
    public function __construct($interface)
    {
        $this->interface = $interface;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return class_implements($value, $this->interface);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute has not implements $this->interface.";
    }
}
