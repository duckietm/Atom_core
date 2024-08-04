<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\UiText;
use Illuminate\Console\Command;
use function Laravel\Prompts\progress;

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
        $texts = json_decode(file_get_contents(base_path('nitro/nitro-assets/gamedata/UITexts.json')), true);

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
        return !!UiText::withoutEvents(fn () => UiText::updateOrCreate(
            ['key' => $key],
            ['value' => $value],
        ));
    }
}
