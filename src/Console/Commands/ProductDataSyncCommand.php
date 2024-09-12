<?php

namespace Atom\Core\Console\Commands;

use Atom\Core\Models\ProductData;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\progress;

class ProductDataSyncCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'atom:sync-product-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command for syncing the product data.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $file = Storage::disk('static')
            ->get(config('nitro.product_data_file'));

        if (! $file) {
            $this->error(sprintf('The product data file is empty or missing in %s.', Storage::disk('static')->path(config('nitro.product_data_file'))));

            return 1;
        }

        $productData = json_decode($file, true);

        progress(
            label: 'Syncing Product Data',
            steps: Arr::get($productData, 'productdata.product'),
            callback: fn (array $item) => $this->sync($item),
        );
    }

    /**
     * Sync the local badge data.
     */
    public function sync(array $item): bool
    {
        return (bool) ProductData::withoutEvents(fn () => ProductData::updateOrCreate(
            ['code' => Arr::get($item, 'code')],
            ['name' => Arr::get($item, 'name'), 'description' => Arr::get($item, 'description')],
        ));
    }
}
