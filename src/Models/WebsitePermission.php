<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WebsitePermission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission',
        'min_rank',
        'description',
    ];
}
