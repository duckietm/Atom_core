<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteUserGuestbook extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_user_guestbooks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'user_id',
        'message',
    ];

    /**
     * Get the user that owns the guestbook entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the profile that owns the guestbook entry.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(User::class, 'profile_id');
    }
}
