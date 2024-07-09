<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteStaffApplications extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_staff_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'rank_id',
        'content',
    ];

    /**
     * Get the user that owns the staff application.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rank that owns the staff application.
     */
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
