<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items';

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
        'room_id',
        'item_id',
        'wall_pos',
        'x',
        'y',
        'z',
        'rot',
        'extra_data',
        'wired_data',
        'limited_data',
        'guild_id',
    ];

    /**
     * Get the user that owns the item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the item base that owns the item.
     */
    public function itemBase(): BelongsTo
    {
        return $this->belongsTo(ItemBase::class, 'item_id');
    }

    /**
     * Get the room that owns the item.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    /**
     * Get the catalog items for the item.
     */
    public function catalogItems(): HasMany
    {
        return $this->hasMany(CatalogItem::class, 'item_ids', 'item_id');
    }
}
