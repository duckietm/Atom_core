<?php

namespace Atom\Core\Models;

use Atom\Core\Observers\FurnitureDataObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([FurnitureDataObserver::class])]
class FurnitureData extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'furniture_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'classname',
        'name',
        'revision',
        'description',
        'category',
        'offerid',
        'defaultdir',
        'xdim',
        'ydim',
        'partcolors',
        'adurl',
        'type',
        'buyout',
        'rentofferid',
        'rentbuyout',
        'bc',
        'excludeddynamic',
        'customparams',
        'specialtype',
        'canstandon',
        'cansiton',
        'canlayon',
        'furniline',
        'environment',
        'rare',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'buyout' => 'boolean',
        'rentbuyout' => 'boolean',
        'bc' => 'boolean',
        'excludeddynamic' => 'boolean',
        'partcolors' => 'object',
        'canstandon' => 'boolean',
        'cansiton' => 'boolean',
        'canlayon' => 'boolean',
        'rare' => 'boolean',
    ];
}
