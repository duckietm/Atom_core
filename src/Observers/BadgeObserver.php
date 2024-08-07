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
        $externalTexts = json_decode(file_get_contents(config('nitro.external_texts_file')), true);

        if ($badge->isDirty('name')) {
            Arr::set($externalTexts, sprintf('badge_name_%s', $badge->code), $badge->name);
        }

        if ($badge->isDirty('description')) {
            Arr::set($externalTexts, sprintf('badge_desc_%s', $badge->code), $badge->description);
        }

        file_put_contents(
            config('nitro.external_texts_file'),
            json_encode($externalTexts),
        );
    }

    /**
     * Handle the Badge "deleted" event.
     */
    public function deleted(Badge $badge): void
    {
        $externalTexts = json_decode(file_get_contents(config('nitro.external_texts_file')), true);

        Arr::forget($externalTexts, sprintf('badge_name_%s', $badge->code));
        Arr::forget($externalTexts, sprintf('badge_desc_%s', $badge->code));

        file_put_contents(
            config('nitro.external_texts_file'),
            json_encode($externalTexts),
        );
    }
}
