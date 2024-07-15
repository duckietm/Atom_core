<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogClothing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_clothing';

    /**
     * Determine if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'setid',
    ];
}
