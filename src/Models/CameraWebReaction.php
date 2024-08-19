<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CameraWebReaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'camera_web_reactions';

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
        'camera_web_id',
        'reaction',
    ];

    /**
     * Get the user that reacted to the camera web.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the camera web that the reaction belongs to.
     */
    public function cameraWeb(): BelongsTo
    {
        return $this->belongsTo(CameraWeb::class, 'camera_web_id');
    }
}
