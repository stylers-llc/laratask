<?php

namespace Stylers\Laratask\Interfaces;

/**
 * Interface AssignableInterface
 * @package Stylers\Laratask\Interfaces
 */
interface AssignableInterface
{
    public function assignedTaskTemplates();

    public function assignedTasks();

    public function getName();
}