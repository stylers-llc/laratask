<?php

namespace Stylers\Laratask\Rules;


use Illuminate\Contracts\Validation\Rule;
use Stylers\Laratask\Support\DateInterval;

class DateDiffGreaterOrEqual implements Rule
{
    /**
     * @var \DateTimeInterface
     */
    private $from;

    /**
     * @var \DateTimeInterface
     */
    private $to;

    public function __construct(\DateTimeInterface $from, \DateTimeInterface $to = null)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \Exception
     */
    public function passes($attribute, $value)
    {
        $interval = new DateInterval($value);

        if ($this->to) $diff = strtotime($this->to) - strtotime($this->from);
        else $diff = strtotime($this->from);

        return $interval->__toSeconds() <= $diff;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.date_diff_greater_or_equal', ['attribute' => ':attribute']);
    }
}