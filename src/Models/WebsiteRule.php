<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteRule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_rules';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'paragraph',
        'rule',
    ];

    /**
     * Get the category that owns the rule.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WebsiteRuleCategory::class, 'category_id');
    }
}
