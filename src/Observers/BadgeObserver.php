<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\Badge;
use Illuminate\Support\Arr;

class BadgeObserver
{
    /**
     * Handle the Badge "saved" event.
     */
    public function saved(Badge $badge): void
    {
        $externalTexts = json_decode(file_get_contents(base_path('nitro/nitro-assets/gamedata/ExternalTexts.json')), true);

        if ($badge->isDirty('name')) {
            Arr::set($externalTexts, sprintf('badge_name_%s', $badge->code), $badge->name);
        }

        if ($badge->isDirty('description')) {
            Arr::set($externalTexts, sprintf('badge_desc_%s', $badge->code), $badge->description);
        }

        file_put_contents(
            base_path('nitro/nitro-assets/gamedata/ExternalTexts.json'),
            json_encode($externalTexts),
        );
    }
}
