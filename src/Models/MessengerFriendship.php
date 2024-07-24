<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessengerFriendship extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messenger_friendships';

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
        'user_one_id',
        'user_two_id',
        'relation',
        'friends_since',
        'category',
    ];

    /**
     * Get the user that is the first user in the friendship.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_one_id', 'id');
    }

    /**
     * Get the user that is the second user in the friendship.
     */
    public function friend(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_two_id', 'id');
    }
}
