<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogItemBuildersClub extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_items_bc';

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
        'item_ids',
        'page_id',
        'catalog_name',
        'order_number',
        'extradata',
    ];

    /**
     * Get the page that owns the catalog item.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(CatalogPageBuildersClub::class, 'page_id');
    }

    /**
     * Set the extradata.
     */
    public function setExtradataAttribute($value)
    {
        $this->attributes['extradata'] = is_null($value) ? '' : $value;
    }
}
