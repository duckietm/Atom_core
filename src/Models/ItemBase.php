<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class ItemBase extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items_base';

    /**
     * Determine if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sprite_id',
        'public_name',
        'item_name',
        'type',
        'width',
        'length',
        'stack_height',
        'allow_stack',
        'allow_sit',
        'allow_lay',
        'allow_walk',
        'allow_gift',
        'allow_trade',
        'allow_recycle',
        'allow_marketplace_sell',
        'allow_inventory_stack',
        'interaction_type',
        'interaction_modes_count',
        'vending_ids',
        'multiheight',
        'customparams',
        'effect_id_male',
        'effect_id_female',
        'clothing_on_walk',
    ];
}
