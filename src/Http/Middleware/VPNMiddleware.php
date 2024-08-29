<?php

namespace Atom\Core\Http\Middleware;

use Atom\Core\Models\WebsiteIpBlacklist;
use Atom\Core\Models\WebsiteIpWhitelist;
use Atom\Core\Services\ProxyDetectionService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VPNMiddleware
{
    /**
     * Create a new VPN middleware instance.
     */
    public function __construct(public readonly ProxyDetectionService $proxyService)
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

        if (! config('services.ip-api.enabled')) {
            return $next($request);
        }

        if (! auth()->check()) {
            return $next($request);
        }

        if (WebsiteIpWhitelist::where('ip_address', $ipAddress)->exists()) {
            return $next($request);
        }

        if (WebsiteIpBlacklist::where('ip_address', $ipAddress)->exists()) {
            return $this->throwBlacklistError($request, $ipAddress, 'Your IP address has been blacklisted.');
        }

        $response = $this->proxyService->lookup($ipAddress);

        if ($response->status === 'fail') {
            return $next($request);
        }

        if (WebsiteIpWhitelist::where('asn', $response->asname)->where('whitelist_asn', '1')->exists()) {
            return $this->whiteList($request, $next, $ipAddress);
        }

        if (WebsiteIpBlacklist::where('asn', $response->asname)->where('blacklist_asn', '1')->exists()) {
            return $this->throwBlacklistError($request, $ipAddress, 'Your IP address has been blacklisted.');
        }

        return match (true) {
            (bool) $response->proxy => $this->throwBlacklistError($request, $ipAddress, 'Proxy IP addresses are not allowed.'),
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
