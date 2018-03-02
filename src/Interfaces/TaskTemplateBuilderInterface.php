<?php

namespace Stylers\Laratask\Interfaces;

use Stylers\Laratask\Models\TaskTemplate;

interface TaskTemplateBuilderInterface
{
    public function __construct(array $nameTxArray);

    public function setTaskTemplate(TaskTemplate $taskTemplate);

    public function setDescription(array $descriptionArray);

    public function setSubject(TaskableInterface $taskable);

    public function setDelegator(DelegatableInterface $delegatable);

    public function setAssigned(AssignableInterface $assignable);

    public function build();

    public function getTaskTemplate(): TaskTemplate;
}