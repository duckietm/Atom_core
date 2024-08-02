<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteHomeCategory extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_home_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'website_home_category_id',
        'permission_id',
    ];

    /**
     * Get the website home category's parent.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(WebsiteHomeCategory::class, 'website_home_category_id');
    }

    /**
     * Get the children for the category.
     */
    public function children(): HasMany
    {
        return $this->hasMany(WebsiteHomeCategory::class, 'website_home_category_id')
            ->where('permission_id', '<=', auth()->user()?->rank ?? 7)
            ->orderBy('name');
    }

    /**
     * Get the items for the category.
     */
    public function items(): HasMany
    {
        return $this->hasMany(WebsiteHomeItem::class, 'website_home_category_id');
    }

    /**
     * Get the permission for the category.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
