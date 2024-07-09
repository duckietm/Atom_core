<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteBetaCode extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_beta_codes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'user_id',
    ];

    /**
     * Get the user that owns the beta code.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
