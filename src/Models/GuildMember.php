<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GuildMember extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'guilds_members';

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
        'guild_id',
        'user_id',
        'level_id',
        'member_since',
    ];

    /**
     * Get the guild that the member belongs to.
     */
    public function guild(): HasMany
    {
        return $this->hasMany(Guild::class, 'guild_id');
    }

    /**
     * Get the user that is the member.
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }
}
