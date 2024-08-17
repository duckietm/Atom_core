<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class CatalogImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
    ];
}
