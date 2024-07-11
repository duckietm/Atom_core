<?php

namespace Atom\Core\Http\Middleware;

use Atom\Core\Models\Ban;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BannedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return $next($request);
        }

        $ban = $request->user()
            ->bans()
            ->where('timestamp', '<', time())
            ->where('ban_expire', '>', time())
            ->exists() ?: Ban::where('ip', $request->ip())
            ->where('timestamp', '<', time())
            ->where('ban_expire', '>', time())
            ->exists();

        if (! $ban && $request->routeIs('banned')) {
            return redirect()->route('users.me');
        }

        if ($ban && (! $request->routeIs('banned') && ! $request->routeIs('help-center.*') && ! $request->routeIs('logout'))) {
            return redirect()->route('banned');
        }

        return $next($request);
    }
}
