<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\ProductData;
use Illuminate\Support\Facades\Storage;

class ProductDataObserver
{
    /**
     * Handle the Product Data "saved" event.
     */
    public function saved(ProductData $productData): void
    {
        $products = json_decode(Storage::disk('static')->get(config('nitro.product_data_file')), true);

        $items = collect($products['productdata']['product'])
            ->filter(fn ($item) => $item['code'] != $productData->code)
            ->push([
                'code' => $productData->code,
                'name' => $productData->name ?: '',
                'description' => $productData->description ?: '',
            ]);

        $products['productdata']['product'] = $items->values()->toArray();

        Storage::disk('static')
            ->put(config('nitro.product_data_file'), json_encode($products));
    }

    /**
     * Handle the Product Data "deleted" event.
     */
    public function deleted(ProductData $productData): void
    {
        $products = json_decode(Storage::disk('static')->get(config('nitro.product_data_file')), true);

        $products['productdata']['product'] = collect($products['productdata']['product'])
            ->filter(fn ($product) => $product['code'] !== $productData->code)
            ->values()
            ->toArray();

        Storage::disk('static')
            ->put(config('nitro.product_data_file'), json_encode($products));
    }
}
