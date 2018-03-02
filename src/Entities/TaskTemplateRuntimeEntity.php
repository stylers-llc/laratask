<?php

namespace Stylers\Laratask\Entities;

use Stylers\Laratask\Entities\Traits\Collectionable;
use Stylers\Laratask\Entities\Traits\TxName;
use Stylers\Laratask\Interfaces\EntityInterface;
use Stylers\Laratask\Models\TaskTemplateRuntime;

/**
 * Class TaskTemplateRuntimeEntity
 * @package Stylers\Laratask\Entities
 */
class TaskTemplateRuntimeEntity implements EntityInterface
{
    use Collectionable;

    /**
     * @var TaskTemplateRuntime
     */
    private $model;

    /**
     * TaskTemplateRuntimeEntity constructor.
     * @param TaskTemplateRuntime $model
     */
    public function __construct(TaskTemplateRuntime $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $additions
     * @return array
     */
    public function getFrontendData(array $additions = []): array
    {
        $model = $this->model;
        $data = [
            'id' => $model->id,
            'start_at' => $model->start_at->format('Y-m-d H:i:s'),
            'end_at' => $model->end_at ? $model->end_at->format('Y-m-d H:i:s') : null,
            'exclude_start_date' => $model->exclude_start_date,
            'date_interval' => $model->date_interval,
        ];

        return $data;
    }
}