<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteArticleComment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_article_comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'user_id',
        'comment',
    ];

    /**
     * Get the user that wrote the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the article that the comment belongs to.
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(WebsiteArticle::class, 'article_id');
    }
}
