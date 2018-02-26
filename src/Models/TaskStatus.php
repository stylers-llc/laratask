<?php

namespace Stylers\Laratask\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;

/**
 * Class TaskStatus
 * @package Stylers\Laratask\Models
 */
class TaskStatus extends Model
{
    use SoftDeletes;

    protected $table = 'taxonomies';

    public function name()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'name_tx_id');
    }
}