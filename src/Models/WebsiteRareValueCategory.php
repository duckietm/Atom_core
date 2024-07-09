<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteRareValueCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_rare_value_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'badge',
        'priority',
    ];

    /**
     * Get the rare values for the category.
     */
    public function rareValues(): HasMany
    {
        return $this->hasMany(WebsiteRareValue::class, 'category_id');
    }
}
