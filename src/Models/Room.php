<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rooms';

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
        'owner_id',
        'owner_name',
        'name',
        'description',
        'model',
        'password',
        'state',
        'users',
        'users_max',
        'guild_id',
        'category',
        'score',
        'paper_floor',
        'paper_wall',
        'paper_landscape',
        'thickness_wall',
        'wall_height',
        'thickness_floor',
        'moodlight_data',
        'tags',
        'is_public',
        'is_staff_picked',
        'allow_other_pets',
        'allow_other_pets_eat',
        'allow_walkthrough',
        'allow_hidewall',
        'chat_mode',
        'chat_weight',
        'chat_speed',
        'chat_hearing_distance',
        'chat_protection',
        'override_model',
        'who_can_mute',
        'who_can_kick',
        'who_can_ban',
        'poll_id',
        'roller_speed',
        'promoted',
        'trade_mode',
        'move_diagonally',
        'jukebox_active',
        'hidewired',
        'is_forsale',
    ];

    /**
     * Get the owner of the room.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get the items for the room.
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'room_id');
    }

    /**
     * Get the guild that owns the room.
     */
    public function guild(): HasOne
    {
        return $this->hasOne(Guild::class, 'room_id');
    }
}
