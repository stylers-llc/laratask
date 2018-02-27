<?php

namespace Stylers\Laratask\Interfaces;

interface DelegatableInterface
{
    public function delegatedTaskTemplates();

    public function delegatedTasks();

    public function getName();
}