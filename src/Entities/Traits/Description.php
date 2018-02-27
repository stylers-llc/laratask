<?php

namespace Stylers\Laratask\Entities\Traits;

use Stylers\Taxonomy\Entities\DescriptionEntity;

trait Description
{
    protected function getDescription()
    {
        $description = new DescriptionEntity($this->model->description);
        return $description->getFrontendData();
    }
}