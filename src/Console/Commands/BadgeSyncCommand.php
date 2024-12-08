<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\Badge;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\progress;

class BadgeSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:sync-badges';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for syncing the badges.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = config('nitro.external_texts_file');

        // Validate file path in configuration
        if (! $filePath) {
            $this->error('The configuration for the external texts file is missing.');
            return 1;
        }

        // Attempt to read the file
        try {
            $file = Storage::disk('static')->get($filePath);
        } catch (\Exception $e) {
            $this->error(sprintf('Error reading the file from disk: %s', $e->getMessage()));
            return 1;
        }

        // Handle missing or empty file
        if (! $file) {
            $this->error(sprintf('The external texts file is empty or missing in %s.', Storage::disk('static')->path($filePath)));
            return 1;
        }

        // Decode JSON and handle errors
        $decoded = json_decode($file, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error(sprintf('Error decoding JSON: %s', json_last_error_msg()));
            return 1;
        }

        // Filter badges
        $badges = collect($decoded)
            ->filter(fn ($value, $key) => str_starts_with($key, 'badge_name_') || str_starts_with($key, 'badge_desc_'));

        // Handle empty badge data
        if ($badges->isEmpty()) {
            $this->info('No badges to sync.');
            return 0;
        }

        // Process badges with progress bar
        progress(
            label: 'Syncing badges',
            steps: $badges->keys()->toArray(),
            callback: function ($key) use ($badges) {
                try {
                    $this->sync($key, $badges[$key]);
                } catch (\Exception $e) {
                    $this->error(sprintf('Failed to sync %s: %s', $key, $e->getMessage()));
                }
            }
        );

        $this->info('Badge synchronization completed.');

        return 0;
    }

    /**
     * Sync the local badge data.
     */
    public function sync(string $key, string $value): bool
    {
        $code = trim(str_replace(['badge_name_', 'badge_desc_'], '', $key));
        $column = str_starts_with($key, 'badge_name_') ? 'name' : 'description';

        try {
            return (bool) Badge::withoutEvents(fn () => Badge::updateOrCreate(
                ['code' => $code, 'file' => sprintf('%s.gif', $code)],
                [$column => $value]
            ));
        } catch (\Exception $e) {
            $this->error(sprintf('Error syncing badge "%s": %s', $code, $e->getMessage()));
            return false;
        }
    }
}
