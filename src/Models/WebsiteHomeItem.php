<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class WebsiteHomeItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_home_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'website_home_category_id',
        'type',
        'count',
        'price',
        'currency_type',
        'currency_price',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * The attributes that should be appended.
     *
     * @var array
     */
    protected $appends = ['image'];

    /**
     * Get the website home category that owns the item.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(WebsiteHomeCategory::class, 'website_home_category_id');
    }

    /**
     * Get all of the users that are assigned this item.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('left', 'top', 'data')
            ->withTimestamps();
    }

    /**
     * Get the image attribute.
     */
    public function getImageAttribute(): string
    {
        return Storage::url($this->image_url);
    }

    /**
     * Set the data attribute.
     */
    public function setDataAttibute($value): void
    {
        $this->attributes['data'] = ! is_null($value) ? (object) $value : (object) [];
    }
}
