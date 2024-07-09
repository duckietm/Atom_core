<?php

namespace Atom\Core\Models;

class WebsiteIpBlacklist extends WebsiteIpWhitelist
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'website_ip_blacklist';
}
