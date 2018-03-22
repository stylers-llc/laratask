<?php

namespace Stylers\Laratask\Enums;

use Stylers\Laratask\Interfaces\EnumInterface;

abstract class TaskTemplateRuntimeInterval extends AbstractEnum implements EnumInterface
{
    const SINGLE = ''; // never repeat
    const P7D = 'P7D'; // 1 week
    const P14D = 'P14D'; // 2 week
    const P1M = 'P1M'; // 1 month
    const P3M = 'P3M'; // 3 month
    const P1Y = 'P1Y'; // 1 year
}