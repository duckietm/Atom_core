<?php

namespace Atom\Core\Models;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteShopArticle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_shop_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'info',
        'icon',
        'color',
        'costs',
        'give_rank',
        'credits',
        'duckets',
        'diamonds',
        'badges',
        'furniture',
        'position',
        'website_shop_category_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'badges' => 'array',
        'furniture' => 'array',
    ];

    /**
     * Get the category that owns the shop article.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WebsiteShopCategory::class, 'website_shop_category_id');
    }

    /**
     * Get the rank that owns the shop article.
     */
    public function rank(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'give_rank');
    }

    /**
     * Get the features for the shop article.
     */
    public function features(): HasMany
    {
        return $this->HasMany(WebsiteShopArticleFeature::class, 'article_id', 'id');
    }

    /**
     * Get the badge items from the badges array.
     *
     * @return array
     */
    public function getBadgeItemsAttribute(): array
    {
        return collect($this->badges)
            ->pluck('fields.code')
            ->toArray();
    }

    /**
     * Get the items from the furnitures array.
     */
    public function getItemsAttribute(): Collection
    {
        $items = ItemBase::whereIn('id', collect($this->furniture)->pluck('fields.id'))
            ->get();

        return collect($this->furniture)
            ->pluck('fields')
            ->map(fn (array $item) => (object) [ ...$item, 'item' => $items->firstWhere('id', $item['id']) ]);
    }
}
