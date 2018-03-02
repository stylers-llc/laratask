<?php

namespace Stylers\Laratask\Builders;

use Illuminate\Support\Facades\DB;
use Stylers\Laratask\Interfaces\DateIntervalInterface;
use Stylers\Laratask\Interfaces\TaskTemplateRuntimeBuilderInterface;
use Stylers\Laratask\Models\TaskTemplateRuntime;
use Stylers\Taxonomy\Manipulators\TaxonomySetter;
use DateTimeInterface;

/**
 * Class TaskTemplateBuilder
 * @package Stylers\Laratask\Builders
 */
class TaskTemplateRuntimeBuilder implements TaskTemplateRuntimeBuilderInterface
{
    /**
     * @var $taskTemplateRuntime
     */
    private $taskTemplateRuntime;

    /**
     * @var array
     */
    private $nameTxArray;

    /**
     * @var DateTimeInterface
     */
    private $startAt;

    /**
     * @var DateTimeInterface
     */
    private $endAt = null;

    /**
     * @var bool
     */
    private $excludeStartDate = false;

    /**
     * @var DateIntervalInterface
     */
    private $dateInterval;

    /**
     * TaskTemplateBuilder constructor.
     * @param array $nameTxArray
     */
    public function __construct(array $nameTxArray)
    {
        $this->nameTxArray = $nameTxArray;
        $this->taskTemplateRuntime = new TaskTemplateRuntime();
    }

    /**
     * @param TaskTemplateRuntime $taskTemplateRuntime
     */
    public function setTaskTemplateRuntime(TaskTemplateRuntime $taskTemplateRuntime)
    {
        $this->taskTemplateRuntime = $taskTemplateRuntime;
    }

    /**
     * @param mixed $startAt
     */
    public function setStartAt(DateTimeInterface $startAt)
    {
        $this->startAt = $startAt;
    }

    /**
     * @param mixed $endAt
     */
    public function setEndAt(DateTimeInterface $endAt)
    {
        $this->endAt = $endAt;
    }

    /**
     * @param mixed $excludeStartDate
     */
    public function setExcludeStartDate(bool $excludeStartDate)
    {
        $this->excludeStartDate = $excludeStartDate;
    }

    /**
     * @param mixed $dateInterval
     */
    public function setDateInterval(DateIntervalInterface $dateInterval)
    {
        $this->dateInterval = $dateInterval;
    }

    /**
     * Build TaskTemplateRuntime
     */
    public function build()
    {
        DB::transaction(function () {
            $this->storeName();

            $this->taskTemplateRuntime->start_at = $this->startAt;
            $this->taskTemplateRuntime->end_at = $this->endAt;
            $this->taskTemplateRuntime->exclude_start_date = $this->excludeStartDate;
            $this->taskTemplateRuntime->date_interval = $this->dateInterval->__toString();

            $this->taskTemplateRuntime->save();
        });
    }

    /**
     * @throws \Exception
     */
    private function storeName()
    {
        $setter = new TaxonomySetter(
            $this->nameTxArray['translations'],
            $this->taskTemplateRuntime->name_tx_id,
            config("laratask.taxonomy.task_template_runtime_names")
        );
        $nameTx = $setter->set();
        $this->taskTemplateRuntime->name_tx_id = $nameTx->id;
    }

    /**
     * @return TaskTemplateRuntime
     */
    public function getTaskTemplateRuntime(): TaskTemplateRuntime
    {
        return $this->taskTemplateRuntime;
    }
}