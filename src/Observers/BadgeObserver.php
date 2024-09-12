<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\Badge;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class BadgeObserver
{
    /**
     * Handle the Badge "saved" event.
     */
    public function saved(Badge $badge): void
    {
        $file = Storage::disk('static')
            ->get(config('nitro.external_texts_file'));

        if (! $file) {
            return;
        }

        $externalTexts = json_decode($file, true);

        Arr::set($externalTexts, sprintf('badge_name_%s', $badge->code), $badge->name);

        Arr::set($externalTexts, sprintf('badge_desc_%s', $badge->code), $badge->description);

        Storage::disk('static')
            ->put(config('nitro.external_texts_file'), json_encode($externalTexts));
    }

    /**
     * Handle the Badge "deleted" event.
     */
    public function deleted(Badge $badge): void
    {
        $file = Storage::disk('static')
            ->get(config('nitro.external_texts_file'));

        if (! $file) {
            return;
        }

        $externalTexts = json_decode($file, true);

        Arr::forget($externalTexts, sprintf('badge_name_%s', $badge->code));

        Arr::forget($externalTexts, sprintf('badge_desc_%s', $badge->code));

        Storage::disk('static')
            ->put(config('nitro.external_texts_file'), json_encode($externalTexts));
    }
}
