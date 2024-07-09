<?php

namespace Atom\Core\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteIpWhitelist extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_ip_whitelist';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'asn',
        'whitelist_asn',
    ];
}
