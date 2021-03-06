<?php

namespace Stylers\Laratask\Interfaces;


use Stylers\Laratask\Models\TaskTemplateRuntime;

/**
 * Interface TaskTemplateRuntimeBuilderInterface
 * @package Stylers\Laratask\Interfaces
 */
interface TaskTemplateRuntimeBuilderInterface
{
    public function __construct();

    public function setTaskTemplateRuntime(TaskTemplateRuntime $taskTemplateRuntime);

    public function setStartAt(\DateTimeInterface $startAt);

    public function setEndAt(\DateTimeInterface $endAt);

    public function setExcludeStartDate(bool $excludeStartDate);

    public function setDateInterval(DateIntervalInterface $dateInterval);

    public function build();

    public function getTaskTemplateRuntime(): TaskTemplateRuntime;
}