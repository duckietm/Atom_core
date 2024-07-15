<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WordFilter extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wordfilter';

    /**
     * Determine if the model should be timestamped.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'key';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'key',
        'replacement',
        'hide',
        'report',
        'mute',
    ];
}
