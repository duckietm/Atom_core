<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'furniture' => 'array',
    ];

    /**
     * Get the rank that owns the shop article.
     */
    public function rank(): HasOne
    {
        return $this->hasOne(Permission::class, 'id', 'give_rank');
    }

    /**
     * Get the features for the shop article.
     */
    public function features(): HasMany
    {
        return $this->HasMany(WebsiteShopArticleFeature::class, 'article_id', 'id');
    }
}
