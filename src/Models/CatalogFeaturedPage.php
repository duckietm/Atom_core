<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CatalogFeaturedPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_featured_pages';

    /**
     * Determine if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'slot_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slot_id',
        'image',
        'caption',
        'type',
        'expire_timestamp',
        'page_name',
        'page_id',
        'product_name',
    ];

    /**
     * Get the page that owns the featured page.
     */
    public function page(): BelongsTo
    {
        return $this->belongsTo(CatalogPage::class, 'page_id');
    }

    /**
     * Set the page name attribute.
     */
    public function setProductNameAttribute($value)
    {
        $this->attributes['product_name'] = !is_null($value) ? $value : '';
    }
}
