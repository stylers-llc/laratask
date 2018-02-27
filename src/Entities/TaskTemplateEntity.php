<?php

namespace Stylers\Laratask\Entities;

use Stylers\Laratask\Entities\Traits\Collectionable;
use Stylers\Laratask\Entities\Traits\TxName;
use Stylers\Laratask\Interfaces\EntityInterface;
use Stylers\Laratask\Models\TaskTemplate;

class TaskTemplateEntity implements EntityInterface
{
    use Collectionable;
    use TxName;

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
            'name' => $model->getName(),
        ];

        return $data;
    }
}