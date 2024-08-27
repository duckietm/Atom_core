<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteRareValue extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_rare_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'item_id',
        'name',
        'credit_value',
        'currency_value',
        'currency_type',
        'furniture_icon',
    ];

    /**
     * Get the category that the rare value belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WebsiteRareValueCategory::class, 'category_id');
    }

    /**
     * Get the item that the rare value belongs to.
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(ItemBase::class, 'item_id');
    }
}
