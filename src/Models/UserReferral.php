<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserReferral extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_referrals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'referrals_total',
    ];

    /**
     * Get the user that owns the referral.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
