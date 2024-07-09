<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserSubscription extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_subscriptions';

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
        'subscription_type',
        'timestamp_start',
        'duration',
        'active',
    ];

    /**
     * Get the user that owns the subscription.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
