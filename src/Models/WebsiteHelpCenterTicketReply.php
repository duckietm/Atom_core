<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Atom\Core\Observers\WebsiteHelpCenterTicketReplyObserver;

#[ObservedBy([WebsiteHelpCenterTicketReplyObserver::class])]
class WebsiteHelpCenterTicketReply extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_help_center_ticket_replies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_id',
        'user_id',
        'content',
    ];

    /**
     * Get the user that owns the reply.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the ticket that owns the reply.
     */
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(WebsiteHelpCenterTicket::class, 'ticket_id');
    }
}
