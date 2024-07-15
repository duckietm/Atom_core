<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Atom\Core\Observers\CatalogPageObserver;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CatalogPageObserver::class])]
class CatalogPageBuildersClub extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_pages_bc';

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
        'parent_id',
        'caption',
        'page_layout',
        'icon_color',
        'icon_image',
        'order_num',
        'visible',
        'enabled',
        'page_headline',
        'page_teaser',
        'page_special',
        'page_text1',
        'page_text2',
        'page_text_details',
        'page_text_teaser',
    ];

    /**
     * Get the parent page.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Get the children pages.
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * Get the catalog items for the page.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CatalogItemBuildersClub::class, 'page_id');
    }
}
