<?php

namespace Atom\Core\Models;

use Atom\Core\Observers\WebsiteArticleObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([WebsiteArticleObserver::class])]
class WebsiteArticle extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug',
        'title',
        'short_story',
        'full_story',
        'user_id',
        'image',
        'is_published',
        'can_comment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'can_comment' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Get the user that wrote the article.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the comments for the article.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(WebsiteArticleComment::class, 'article_id')
            ->latest();
    }

    /**
     * Get the reactions for the article.
     */
    public function reactions(): HasMany
    {
        return $this->hasMany(WebsiteArticleReaction::class, 'article_id');
    }
}
