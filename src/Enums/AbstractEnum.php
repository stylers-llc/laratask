<?php

namespace Stylers\Laratask\Enums;

use Stylers\Laratask\Interfaces\EnumInterface;
use \ReflectionClass;

abstract class AbstractEnum implements EnumInterface
{
    public static function getConstants(): array
    {
        $class = get_called_class();
        $reflection = new ReflectionClass($class);
        $constants = $reflection->getConstants();
        $constants = array_sort($constants);

        return $constants;
    }
}