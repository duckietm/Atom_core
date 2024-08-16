<?php

namespace Atom\Core\Http\Middleware;

use Closure;
use Kielabokkie\Ipdata;
use Illuminate\Http\Request;
use Atom\Core\Models\WebsiteIpBlacklist;
use Atom\Core\Models\WebsiteIpWhitelist;
use Symfony\Component\HttpFoundation\Response;

class VPNMiddleware
{
    /**
     * Create a new VPN middleware instance.
     */
    public function __construct(public readonly Ipdata $ipdata)
    {
        // 
    }
    
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        $ipAddress = $request->ip();

        if (!config('services.ipdata.enabled') || !auth()->check())
            return $next($request);

        if (WebsiteIpWhitelist::where('ip_address', $ipAddress)->exists())
            return $next($request);

        if (WebsiteIpBlacklist::where('ip_address', $ipAddress)->exists())
            return $this->throwBlacklistError($request, $ipAddress, 'Your IP address has been blacklisted.');

        $response = $this->ipdata->lookup($ipAddress);

        if (WebsiteIpWhitelist::where('asn', $response->asn->asn)->where('whitelist_asn', '1')->exists())
            return $this->whiteList($request, $next, $ipAddress);

        if (WebsiteIpBlacklist::where('asn', $response->asn->asn)->where('blacklist_asn', '1')->exists())
            return $this->throwBlacklistError($request, $ipAddress, 'Your IP address has been blacklisted.');

        return match(true) {
            !!$response->threat->is_icloud_relay => $this->throwBlacklistError($request, $ipAddress, 'iCloud Relay is not allowed.'),
            !!$response->threat->is_datacenter => $this->throwBlacklistError($request, $ipAddress, 'Datacenter IP addresses are not allowed.'),
            !!$response->threat->is_tor => $this->throwBlacklistError($request, $ipAddress, 'Tor IP addresses are not allowed.'),
            !!$response->threat->is_proxy => $this->throwBlacklistError($request, $ipAddress, 'Proxy IP addresses are not allowed.'),
            !!$response->threat->is_known_attacker => $this->throwBlacklistError($request, $ipAddress, 'Known attacker IP addresses are not allowed.'),
            !!$response->threat->is_known_abuser => $this->throwBlacklistError($request, $ipAddress, 'Known abuser IP addresses are not allowed.'),
            !!$response->threat->is_threat => $this->throwBlacklistError($request, $ipAddress, 'Threat IP addresses are not allowed.'),
            count($response->threat->blocklists) > 0 => $this->throwBlacklistError($request, $ipAddress, 'Your IP address is on a blocklist.'),
            default => $this->whiteList($request, $next, $ipAddress),
        };
    }

    /**
     * Whitelist the IP address.
     */
    protected function whiteList(Request $request, Closure $next, string $ipAddress): Response
    {
        WebsiteIpWhitelist::updateOrCreate(
            ['ip_address' => $ipAddress],
        );

        return $next($request);
    }

    /**
     * Throw a blacklist error.
     */
    protected function throwBlacklistError(Request $request, string $ipAddress, string $message): Response
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        WebsiteIpBlacklist::updateOrCreate(
            ['ip_address' => $ipAddress],
        );

        return redirect()
            ->route('login')
            ->withErrors(['username' => $message]);
    }
}
