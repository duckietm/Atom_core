<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogTargetOffer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_target_offers';

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
        'offer_code',
        'title',
        'description',
        'image',
        'icon',
        'end_timestamp',
        'credits',
        'points',
        'points_type',
        'purchase_limit',
        'catalog_item',
        'vars',
    ];

    /**
     * Get the catalog item that owns the catalog target offer.
     */
    public function catalogItem(): BelongsTo
    {
        return $this->belongsTo(CatalogItem::class, 'catalog_item');
    }

    /**
     * Set the vars attribute.
     */
    public function setVarsAttribute($value)
    {
        $this->attributes['vars'] = !is_null($value) ? $value : '';
    }
}
