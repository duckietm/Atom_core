<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteOpenPosition extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_open_positions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'permission_id',
        'description',
        'apply_from',
        'apply_to',
    ];

    /**
     * Get the permission that owns the open position.
     */
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class);
    }
}
