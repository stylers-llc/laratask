<?php

namespace Stylers\Laratask\Entities\Traits;


use Illuminate\Database\Eloquent\Collection;

/**
 * Trait Collectionable
 * @package Stylers\Laratask\Entities\Traits
 */
trait Collectionable
{
    /**
     * @param Collection $collection
     * @param array $additions
     * @return array
     */
    public static function getCollection(Collection $collection, array $additions = []): array
    {
        $list = [];
        foreach ($collection as $model) {
            $entity = new self($model);
            $data = $entity->getFrontendData($additions);
            array_push($list, $data);
        }

        return $list;
    }
}