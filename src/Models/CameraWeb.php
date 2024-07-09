<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CameraWeb extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'camera_web';

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
        'user_id',
        'room_id',
        'timestamp',
        'url',
    ];

    /**
     * Get the user that owns the camera web.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
