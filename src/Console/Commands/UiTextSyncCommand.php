<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\UiText;
use Illuminate\Console\Command;

use function Laravel\Prompts\progress;
use Illuminate\Support\Facades\Storage;

class UiTextSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:sync-ui-texts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for syncing the ui texts.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = Storage::disk('static')
            ->get(config('nitro.ui_texts_file'));

        if (!$file) {
            $this->error(sprintf('The UI Texts file is empty or missing in %s.', Storage::disk('static')->path(config('nitro.ui_texts_file'))));

            return 1;
        }

        $texts = json_decode($file, true);

        progress(
            label: 'Syncing UI Texts',
            steps: array_keys($texts),
            callback: fn ($key) => $this->sync($key, $texts[$key]),
        );
    }

    /**
     * Sync the local UI Text data.
     */
    public function sync(string $key, string $value): bool
    {
        return (bool) UiText::withoutEvents(fn () => UiText::updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        ));
    }
}
