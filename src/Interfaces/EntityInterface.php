<?php

namespace Stylers\Laratask\Interfaces;

use Illuminate\Database\Eloquent\Collection;

/**
 * Interface EntityInterface
 * @package Stylers\Laratask\Interfaces
 */
interface EntityInterface
{
    public static function getCollection(Collection $collection, array $additions = []): array;

    public function getFrontendData(array $additions = []): array;
}