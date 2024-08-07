<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\FurnitureData;

class FurnitureDataObserver
{
    /**
     * Handle the Furniture Data "saved" event.
     */
    public function saved(FurnitureData $furnitureData): void
    {
        $furnitures = json_decode(file_get_contents(config('nitro.furniture_data_file')), true);

        $items = collect($furnitures[$furnitureData->type]['furnitype'])
            ->filter(fn ($item) => $item['id'] != $furnitureData->id)
            ->push($furnitureData->type === 'roomitemtypes'
                ? $furnitureData->only('id', 'classname', 'revision', 'category', 'defaultdir', 'xdim', 'ydim', 'partcolors', 'name', 'description', 'adurl', 'offerid', 'buyout', 'rentofferid', 'rentbuyout', 'bc', 'excludeddynamic', 'customparams', 'specialtype', 'canstandon', 'cansiton', 'canlayon', 'furniline', 'environment', 'rare')
                : $furnitureData->only('id', 'classname', 'revision', 'category', 'name', 'description', 'adurl', 'offerid', 'buyout', 'rentofferid', 'rentbuyout', 'bc', 'excludeddynamic', 'customparams', 'specialtype', 'furniline', 'environment', 'rare')
            );

        $furnitures[$furnitureData->type]['furnitype'] = $items->values()->toArray();

        file_put_contents(
            config('nitro.furniture_data_file'),
            json_encode($furnitures),
        );
    }

    /**
     * Handle the Furniture Data "deleted" event.
     */
    public function deleted(FurnitureData $furnitureData): void
    {
        $furnitures = json_decode(file_get_contents(config('nitro.furniture_data_file')), true);

        $furnitures[$furnitureData->type]['furnitype'] = collect($furnitures[$furnitureData->type]['furnitype'])
            ->filter(fn ($item) => $item['id'] != $furnitureData->id)
            ->values()
            ->toArray();

        file_put_contents(
            config('nitro.furniture_data_file'),
            json_encode($furnitures),
        );
    }
}
