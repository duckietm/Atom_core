<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomTradeLogItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_trade_log_items';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'item_id',
        'user_id',
    ];

    /**
     * Get the trade log that owns the item.
     */
    public function tradeLog(): BelongsTo
    {
        return $this
            ->belongsTo(RoomTradeLog::class, 'id', 'id');
    }

    /**
     * Get the item that owns the trade log item.
     */
    public function item(): BelongsTo
    {
        return $this
            ->belongsTo(Item::class, 'item_id', 'id');
    }
}
