<?php

namespace Stylers\Laratask\Entities;


use Stylers\Laratask\Entities\Traits\Collectionable;
use Stylers\Laratask\Entities\Traits\TxName;
use Stylers\Laratask\Interfaces\EntityInterface;
use Stylers\Laratask\Models\Task;

/**
 * Class TaskEntity
 * @package Stylers\Laratask\Entities
 */
class TaskEntity implements EntityInterface
{
    use Collectionable;
    use TxName;

    /**
     * @var Task
     */
    private $model;

    /**
     * TaskEntity constructor.
     * @param Task $model
     */
    public function __construct(Task $model)
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
            'deadline_at' => $model->deadline_at,
            'executed_at' => $model->executed_at,
        ];

        return $data;
    }
}