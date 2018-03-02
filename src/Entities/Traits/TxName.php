<?php

namespace Stylers\Laratask\Entities\Traits;


use Stylers\Taxonomy\Entities\TaxonomyEntity;

/**
 * Trait TxName
 * @package Stylers\Laratask\Entities\Traits
 */
trait TxName
{
    /**
     * @return array|null
     */
    protected function getName()
    {
        $txEntity = new TaxonomyEntity($this->model->name);
        return $txEntity->getTranslationData();
    }
}