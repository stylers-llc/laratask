<?php

namespace Stylers\Laratask\Entities\Traits;

use Stylers\Taxonomy\Entities\TaxonomyEntity;

trait TxName
{
    protected function getName()
    {
        $txEntity = new TaxonomyEntity($this->model->name);
        return $txEntity->getTranslationData();
    }
}