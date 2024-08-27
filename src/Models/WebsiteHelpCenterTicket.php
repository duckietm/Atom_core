<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteHelpCenterTicket extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_help_center_tickets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'content',
        'open',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'open' => 'boolean',
    ];

    /**
     * Get the user that owns the ticket.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the category that owns the ticket.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WebsiteHelpCenterCategory::class, 'category_id');
    }

    /**
     * Get the replies for the ticket.
     */
    public function replies(): HasMany
    {
        return $this->hasMany(WebsiteHelpCenterTicketReply::class, 'ticket_id')
            ->latest();
    }
}
