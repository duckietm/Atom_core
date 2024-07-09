<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBadge extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_badges';

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
        'slot_id',
        'badge_code',
    ];

    /**
     * Get the user that owns the badge.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
