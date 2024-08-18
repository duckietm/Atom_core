<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_items';

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
        'cost_credits',
        'cost_points',
        'points_type',
        'amount',
        'limited_stack',
        'limited_sells',
        'order_number',
        'offer_id',
        'song_id',
        'extradata',
        'have_offer',
        'club_only',
    ];

    /**
     * Get the page that owns the catalog item.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(CatalogPage::class, 'page_id');
    }

    /**
     * Get the item base that owns the catalog item.
     */
    public function itemBase(): BelongsTo
    {
        return $this->belongsTo(ItemBase::class, 'item_ids');
    }

    /**
     * Set the extradata.
     */
    public function setExtradataAttribute($value)
    {
        $this->attributes['extradata'] = is_null($value) ? '' : $value;
    }
}
