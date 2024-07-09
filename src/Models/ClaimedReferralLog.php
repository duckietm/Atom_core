<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClaimedReferralLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'claimed_referral_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'ip_address',
    ];

    /**
     * Get the user that owns the claimed referral log.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
