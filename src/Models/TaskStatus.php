<?php

namespace Stylers\Laratask\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stylers\Taxonomy\Models\Taxonomy;
use Stylers\Taxonomy\Models\Traits\TxTranslatable;

/**
 * Class TaskStatus
 * @package Stylers\Laratask\Models
 */
class TaskStatus extends Model
{
    use SoftDeletes;
    use TxTranslatable;

    protected $table = 'taxonomies';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function name()
    {
        return $this->hasOne(Taxonomy::class, 'id', 'name_tx_id');
    }
}