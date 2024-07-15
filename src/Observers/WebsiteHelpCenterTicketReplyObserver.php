<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\WebsiteHelpCenterTicketReply;

class WebsiteHelpCenterTicketReplyObserver
{
    /**
     * Handle the WebsiteHelpCenterTicketReply "creating" event.
     */
    public function creating(WebsiteHelpCenterTicketReply $websiteHelpCenterTicketReply): void
    {
        $websiteHelpCenterTicketReply->user_id = auth()->id();
    }
}
