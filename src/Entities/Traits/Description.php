<?php

namespace Stylers\Laratask\Entities\Traits;

use Stylers\Taxonomy\Entities\DescriptionEntity;

trait Description
{
    protected function getDescription()
    {
        if (!$this->model->description) return null;

        $description = new DescriptionEntity($this->model->description);
        return $description->getFrontendData();
    }
}