<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomTradeLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'room_trade_log';

    /**
     * Indicates if the model should be timestamped.
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
        'user_one_id',
        'user_two_id',
        'user_one_ip',
        'user_two_ip',
        'timestamp',
        'user_one_item_count',
        'user_two_item_count',
    ];

    /**
     * Get the items for the trade log.
     */
    public function items(): HasMany
    {
        return $this
            ->hasMany(RoomTradeLogItem::class, 'id', 'id');
    }
}
