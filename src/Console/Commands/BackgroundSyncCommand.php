<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\Badge;
use Atom\Core\Models\RoomAds;

use Illuminate\Console\Command;
use function Laravel\Prompts\progress;

use Illuminate\Support\Facades\Storage;

class BackgroundSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:sync-backgrounds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for syncing the room ads.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $backgrounds = Storage::disk('room_backgrounds')
            ->files();

        progress(
            label: 'Syncing badges',
            steps: $backgrounds,
            callback: fn (string $file) => $this->sync($file),
        );
    }

    /**
     * Sync the local background data.
     */
    public function sync(string $file): bool
    {
        return !!RoomAds::withoutEvents(fn () => RoomAds::updateOrCreate(
            ['file' => $file],
            ['file' => $file],
        ));
    }
}
