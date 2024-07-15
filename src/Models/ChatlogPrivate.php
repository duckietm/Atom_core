<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatlogPrivate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'chatlogs_private';

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
        'user_from_id',
        'user_to_id',
        'message',
        'timestamp',
    ];

    /**
     * Get the user that sent the message.
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_from_id');
    }

    /**
     * Get the user that recieved the message.
     */
    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_to_id');
    }
}
