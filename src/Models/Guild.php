<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Guild extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guilds';

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
        'name',
        'description',
        'room_id',
        'state',
        'rights',
        'color_one',
        'color_two',
        'badge',
        'date_created',
        'forum',
        'read_forum',
        'post_messages',
        'post_threads',
        'mod_forum',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date_created' => 'datetime',
    ];

    /**
     * Get the owner of the guild.
     *
     * @return HasMany
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the members of the guild.
     */
    public function members(): HasMany
    {
        return $this->hasMany(GuildMember::class, 'guild_id');
    }

    /**
     * Get the room that the guild is associated with.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
