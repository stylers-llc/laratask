<?php

namespace Stylers\Laratask\Entities;

use Stylers\Laratask\Entities\Traits\Collectionable;
use Stylers\Laratask\Entities\Traits\Description;
use Stylers\Laratask\Entities\Traits\TxName;
use Stylers\Laratask\Interfaces\EntityInterface;
use Stylers\Laratask\Models\TaskTemplate;

class TaskTemplateEntity implements EntityInterface
{
    use Collectionable;
    use TxName;
    use Description;

    /**
     * @var TaskTemplate
     */
    private $model;

    /**
     * TaskTemplateEntity constructor.
     * @param TaskTemplate $model
     */
    public function __construct(TaskTemplate $model)
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
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'taskable' => $this->getTaskableData(),
            'delegatable' => $this->getDelegatableData(),
            'assignable' => $this->getAssignableData(),
        ];

        return $data;
    }

    private function getTaskableData()
    {
        if (!$this->model->taskable) return null;

        $model = $this->model;
        return [
            'id' => $model->taskable->id,
            'type' => get_class($model->taskable),
            'name' => $model->taskable->getName(),
        ];
    }

    private function getDelegatableData()
    {
        if (!$this->model->delegatable) return null;

        $model = $this->model;
        return [
            'id' => $model->delegatable->id,
            'type' => get_class($model->delegatable),
            'name' => $model->delegatable->getName(),
        ];
    }

    private function getAssignableData()
    {
        if (!$this->model->assignable) return null;

        $model = $this->model;
        return [
            'id' => $model->assignable->id,
            'type' => get_class($model->assignable),
            'name' => $model->assignable->getName(),
        ];
    }
}