<?php

namespace Stylers\Laratask\Support;


use Stylers\Laratask\Interfaces\DateIntervalInterface;

/**
 * Class DateInterval
 * @package Stylers\Laratask\Support
 */
class DateInterval extends \DateInterval implements DateIntervalInterface
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        $date = array_filter(['Y' => $this->y, 'M' => $this->m, 'D' => $this->d]);
        $time = array_filter(['H' => $this->h, 'M' => $this->i, 'S' => $this->s]);

        $str = 'P';
        $this->concat($str, $date);

        if (count($time)) {
            $str .= 'T';
            $this->concat($str, $time);
        }

        return $str;
    }

    /**
     * @param string $str
     * @param array $array
     */
    private function concat(string &$str, array $array)
    {
        foreach ($array as $key => $value) {
            $str .= $value . $key;
        }
    }
}