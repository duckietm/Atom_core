<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsitePaypalTransaction extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_paypal_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'transaction_id',
        'status',
        'description',
        'amount',
        'currency',
    ];

    /**
     * Get the user that owns the transaction.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
