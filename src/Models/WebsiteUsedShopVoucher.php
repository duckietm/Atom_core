<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebsiteUsedShopVoucher extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_used_shop_vouchers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'voucher_id',
    ];

    /**
     * Get the user that owns the used shop voucher.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the voucher that owns the used shop voucher.
     */
    public function voucher(): BelongsTo
    {
        return $this->belongsTo(WebsiteShopVoucher::class, 'voucher_id');
    }
}
