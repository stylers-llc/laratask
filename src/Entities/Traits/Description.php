<?php

namespace Stylers\Laratask\Entities\Traits;


use Stylers\Taxonomy\Entities\DescriptionEntity;

/**
 * Trait Description
 * @package Stylers\Laratask\Entities\Traits
 */
trait Description
{
    /**
     * @return array|null
     */
    protected function getDescription()
    {
        if (!$this->model->description) return null;

        $description = new DescriptionEntity($this->model->description);
        return $description->getFrontendData();
    }
}