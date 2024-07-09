<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteRuleCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_rule_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'badge',
    ];

    /**
     * Get the rules for the category.
     */
    public function rules(): HasMany
    {
        return $this->hasMany(WebsiteRule::class, 'category_id');
    }
}
