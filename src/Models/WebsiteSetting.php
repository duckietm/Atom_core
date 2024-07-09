<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_settings';

    /**
     * Indicates if the model should be timestamped.
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
        'key',
        'value',
        'comment',
    ];
}
