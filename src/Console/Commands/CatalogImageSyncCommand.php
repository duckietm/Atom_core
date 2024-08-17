<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\CatalogImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\progress;

class CatalogImageSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:sync-catalog-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for syncing the catalog images.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $backgrounds = Storage::disk('catalog_images')
            ->files();

        progress(
            label: 'Syncing catalog images',
            steps: $backgrounds,
            callback: fn (string $file) => $this->sync($file),
        );
    }

    /**
     * Sync the local background data.
     */
    public function sync(string $file): bool
    {
        return (bool) CatalogImage::withoutEvents(fn () => CatalogImage::updateOrCreate(
            ['file' => $file],
            ['file' => $file],
        ));
    }
}
