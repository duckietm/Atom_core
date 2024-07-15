<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Atom\Core\Observers\CatalogPageObserver;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([CatalogPageObserver::class])]
class CatalogPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'catalog_pages';

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
        'caption_save',
        'caption',
        'page_layout',
        'icon_color',
        'icon_image',
        'min_rank',
        'order_num',
        'visible',
        'enabled',
        'club_only',
        'vip_only',
        'page_headline',
        'page_teaser',
        'page_special',
        'page_text1',
        'page_text2',
        'page_text_details',
        'page_text_teaser',
        'room_id',
        'includes',
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
     * Get the minimum rank permission.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'min_rank', 'id');
    }

    /**
     * Get the room.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the catalog items.
     */
    public function items(): HasMany
    {
        return $this->hasMany(CatalogItem::class, 'page_id');
    }

    /**
     * Set the `includes` attribute as a comma-separated string.
     *
     * @param  array|string  $value
     * @return void
     */
    public function setIncludesAttribute($value)
    {
        $this->attributes['includes'] = is_array($value)
            ? implode(';', $value)
            : $value;
    }
}
