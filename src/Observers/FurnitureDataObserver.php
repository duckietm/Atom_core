<?php

namespace Atom\Core\Observers;

use Atom\Core\Models\FurnitureData;
use Illuminate\Support\Collection;

class FurnitureDataObserver
{
    /**
     * Handle the Furniture Data "saving" event.
     */
    public function saving(FurnitureData $furnitureData): void
    {
        if (is_null($furnitureData->partcolors)) {
            $furnitureData->partcolors = ['colors' => []];
        }
    }

    /**
     * Handle the Furniture Data "saved" event.
     */
    public function saved(FurnitureData $furnitureData): void
    {
        $furnitures = json_decode(file_get_contents(config('nitro.furniture_data_file')), true);

        $furnitureItems = collect($furnitures[$furnitureData->type]['furnitype'])
            ->filter(fn (array $item) => $item['db_id'] != $furnitureData->id)
            ->when($furnitureData->type === 'wallitemtypes', fn (Collection $items) => $items->push([
                'id' => $furnitureData->item_id,
                'db_id' => $furnitureData->id,
                'classname' => $furnitureData->classname,
                'revision' => $furnitureData->revision,
                'category' => $furnitureData->category,
                'name' => $furnitureData->name,
                'description' => $furnitureData->description,
                'adurl' => $furnitureData->adurl,
                'offerid' => $furnitureData->offerid,
                'buyout' => $furnitureData->buyout,
                'rentofferid' => $furnitureData->rentofferid,
                'rentbuyout' => $furnitureData->rentbuyout,
                'bc' => $furnitureData->bc,
                'excludeddynamic' => $furnitureData->excludeddynamic,
                'customparams' => $furnitureData->customparams,
                'specialtype' => $furnitureData->specialtype,
                'furniline' => $furnitureData->furniline,
                'environment' => $furnitureData->environment,
                'rare' => $furnitureData->rare,
            ]))
            ->when($furnitureData->type === 'roomitemtypes', fn (Collection $items) => $items->push([
                'id' => $furnitureData->item_id,
                'db_id' => $furnitureData->id,
                'classname' => $furnitureData->classname,
                'revision' => $furnitureData->revision,
                'category' => $furnitureData->category,
                'defaultdir' => $furnitureData->defaultdir,
                'xdim' => $furnitureData->xdim,
                'ydim' => $furnitureData->ydim,
                'partcolors' => $furnitureData->partcolors,
                'name' => $furnitureData->name,
                'description' => $furnitureData->description,
                'adurl' => $furnitureData->adurl,
                'offerid' => $furnitureData->offerid,
                'buyout' => $furnitureData->buyout,
                'rentofferid' => $furnitureData->rentofferid,
                'rentbuyout' => $furnitureData->rentbuyout,
                'bc' => $furnitureData->bc,
                'excludeddynamic' => $furnitureData->excludeddynamic,
                'customparams' => $furnitureData->customparams,
                'specialtype' => $furnitureData->specialtype,
                'canstandon' => $furnitureData->canstandon,
                'cansiton' => $furnitureData->cansiton,
                'canlayon' => $furnitureData->canlayon,
                'furniline' => $furnitureData->furniline,
                'environment' => $furnitureData->environment,
                'rare' => $furnitureData->rare,
            ]));

        $furnitures[$furnitureData->type]['furnitype'] = $furnitureItems->values()->toArray();

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
            ->filter(fn (array $item) => $item['db_id'] != $furnitureData->id)
            ->values()
            ->toArray();

        file_put_contents(
            config('nitro.furniture_data_file'),
            json_encode($furnitures),
        );
    }
}
