<?php

namespace Atom\Core\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Console\Command;
use Atom\Core\Models\ProductData;
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
        $productData = json_decode(file_get_contents(base_path('nitro/nitro-assets/gamedata/ProductData.json')), true);

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
        return !!ProductData::withoutEvents(fn () => ProductData::updateOrCreate(
            ['code' => Arr::get($item, 'code')],
            ['name' => Arr::get($item, 'name'), 'description' => Arr::get($item, 'description')],
        ));
    }
}
