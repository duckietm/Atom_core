<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\ProductData;

class ProductDataObserver
{
    /**
     * Handle the Product Data "saved" event.
     */
    public function saved(ProductData $productData): void
    {
        $products = json_decode(file_get_contents(config('nitro.product_data_file')), true);

        $items = collect($products['productdata']['product'])
            ->filter(fn ($item) => $item['code'] != $productData->code)
            ->push([
                'code' => $productData->code,
                'name' => $productData->name ?: '',
                'description' => $productData->description ?: '',
            ]);

        $products['productdata']['product'] = $items->values()->toArray();

        file_put_contents(
            config('nitro.product_data_file'),
            json_encode($products),
        );
    }

    /**
     * Handle the Product Data "deleted" event.
     */
    public function deleted(ProductData $productData): void
    {
        $products = json_decode(file_get_contents(config('nitro.product_data_file')), true);

        $products['productdata']['product'] = collect($products['productdata']['product'])
            ->filter(fn ($product) => $product['code'] !== $productData->code)
            ->values()
            ->toArray();

        file_put_contents(
            config('nitro.product_data_file'),
            json_encode($products),
        );
    }
}
