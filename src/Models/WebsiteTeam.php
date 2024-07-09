<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WebsiteTeam extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_teams';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rank_name',
        'hidden_rank',
        'badge',
        'job_description',
        'staff_color',
        'staff_background',
    ];

    /**
     * Get the users for the team.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'team_id', 'id');
    }
}
