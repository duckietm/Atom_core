<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'approved',
        'url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * Get the user that owns the camera web.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reactions for the camera web.
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(CameraWebReaction::class, 'camera_web_id');
    }
}
