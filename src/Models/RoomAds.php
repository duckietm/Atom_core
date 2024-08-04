<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class RoomAds extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_ads';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file',
    ];
}
