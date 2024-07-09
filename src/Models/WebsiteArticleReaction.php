<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteArticleReaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_article_reactions';

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
        'user_id',
        'article_id',
        'reaction',
        'active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Get the user that reacted to the article.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the article that the reaction belongs to.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(WebsiteArticle::class, 'article_id');
    }
}
