<?php

namespace Atom\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LogoutController extends Controller
{
    /**
     * Handle an incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->session()->invalidate();
 
        $request->session()->regenerateToken();

        return redirect()->route('login.index');
    }
}
