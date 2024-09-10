<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\UiText;
use Illuminate\Support\Facades\Storage;

class UiTextObserver
{
    /**
     * Handle the UiText "saved" event.
     */
    public function saved(UiText $text): void
    {
        $texts = json_decode(Storage::disk('static')->get(config('nitro.ui_texts_file')), true);

        unset($texts[$text->getOriginal('key')]);

        $texts[$text->key] = $text->value;

        Storage::disk('static')
            ->put(config('nitro.ui_texts_file'), json_encode($texts));
    }

    /**
     * Handle the UI Text "deleted" event.
     */
    public function deleted(UiText $text): void
    {
        $texts = json_decode(Storage::disk('static')->get(config('nitro.ui_texts_file')), true);

        unset($texts[$text->key]);

        Storage::disk('static')
            ->put(config('nitro.ui_texts_file'), json_encode($texts));
    }
}
