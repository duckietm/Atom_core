<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteShopCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_shop_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];
}
