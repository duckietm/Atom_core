<?php

namespace Atom\Core\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;

class ProxyDetectionService
{
    /**
     * The service instance.
     */
    protected PendingRequest $service;

    /**
     * The fields to use in the query.
     */
    protected array $fields = [
        'status',
        'message',
        // 'continent',
        // 'continentCode',
        // 'country',
        // 'countryCode',
        // 'region',
        // 'regionName',
        // 'city',
        // 'district',
        // 'zip',
        // 'lat',
        // 'lon',
        // 'timezone',
        // 'offset',
        // 'currency',
        // 'isp',
        // 'org',
        // 'as',
        'asname',
        // 'reverse',
        // 'mobile',
        'proxy',
        'hosting',
        // 'query',
    ];

    /**
     * Construct the proxy detection service.
     */
    public function __construct()
    {
        $this->service = Http::baseUrl('http://ip-api.com')
            ->withOptions(['verify' => false]);
    }

    /**
     * Lookup the IP address.
     */
    public function lookup(string $ipAddress): object
    {
        return (object) $this->service
            ->get(sprintf('/json/%s?fields=%s', $ipAddress, implode(',', $this->fields)))
            ->json();
    }
}
