<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteShopArticleFeature extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_shop_article_features';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'article_id',
        'content',
    ];

    /**
     * Get the article that owns the feature.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(WebsiteShopArticle::class, 'article_id');
    }
}
