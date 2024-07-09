<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteMaintenanceTask extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_maintenance_tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'task',
        'completed',
    ];

    /**
     * Get the user that owns the maintenance task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
