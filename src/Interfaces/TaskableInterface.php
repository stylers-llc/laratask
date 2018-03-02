<?php

namespace Stylers\Laratask\Interfaces;

/**
 * Interface TaskableInterface
 * @package Stylers\Laratask\Interfaces
 */
interface TaskableInterface
{
    public function taskedTaskTemplates();

    public function taskedTasks();

    public function getName();
}