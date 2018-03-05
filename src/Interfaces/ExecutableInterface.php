<?php

namespace Stylers\Laratask\Interfaces;

/**
 * Interface ExecutableInterface
 * @package Stylers\Laratask\Interfaces
 */
interface ExecutableInterface
{
    public function executedTasks();

    public function getName();
}