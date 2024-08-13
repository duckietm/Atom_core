<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\Ban;
use Carbon\Carbon;

class BanObserver
{
    /**
     * Handle the Ban "creating" event.
     */
    public function creating(Ban $ban): void
    {
        $ban->ban_expire = Carbon::parse($ban->ban_expire)->timestamp;
        $ban->timestamp = now()->timestamp;
        $ban->user_staff_id = auth()->id();
        $ban->ip = $ban->user->ip_current;
        $ban->machine_id = $ban->user->machine_id ?: '';
    }
}
