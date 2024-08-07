<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\UiText;

class UiTextObserver
{
    /**
     * Handle the UiText "saved" event.
     */
    public function saved(UiText $text): void
    {
        $texts = json_decode(file_get_contents(config('nitro.ui_texts_file')), true);

        unset($texts[$text->getOriginal('key')]);

        $texts[$text->key] = $text->value;

        file_put_contents(
            config('nitro.ui_texts_file'),
            json_encode($texts),
        );
    }

    /**
     * Handle the UI Text "deleted" event.
     */
    public function deleted(UiText $text): void
    {
        $texts = json_decode(file_get_contents(config('nitro.ui_texts_file')), true);

        unset($texts[$text->key]);

        file_put_contents(
            config('nitro.ui_texts_file'),
            json_encode($texts),
        );
    }
}
