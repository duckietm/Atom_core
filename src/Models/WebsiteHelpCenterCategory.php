<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteHelpCenterCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_help_center_categories';

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
        'name',
        'content',
        'position',
        'image_url',
        'button_text',
        'button_url',
        'button_color',
        'button_border_color',
        'small_box',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'small_box' => 'boolean',
    ];

    /**
     * Get the tickets for the category.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(WebsiteHelpCenterTicket::class, 'category_id');
    }
}
