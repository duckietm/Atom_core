<?php

namespace Atom\Core\Http\Controllers;

use App\Events\UserLogout;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    /**
     * Handle an incoming request.
     */
    public function __invoke(Request $request)
    {
        UserLogout::dispatch($request->user());

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
