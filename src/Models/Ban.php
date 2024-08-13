<?php

namespace Atom\Core\Models;

use Atom\Core\Observers\BanObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ObservedBy(BanObserver::class)]
class Ban extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bans';

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
        'ip',
        'machine_id',
        'user_staff_id',
        'timestamp',
        'ban_expire',
        'ban_reason',
        'type',
        'cfh_topic',
    ];

    /**
     * Get the user that owns the ban.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the staff member that banned the user.
     */
    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_staff_id', 'id');
    }
}
