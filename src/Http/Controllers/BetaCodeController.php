<?php

namespace Atom\Core\Http\Controllers;

use Atom\Core\Models\WebsiteBetaCode;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BetaCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $secret = @file_get_contents(storage_path('framework/down'));

        $beta = WebsiteBetaCode::firstWhere('code', $request->input('code'));

        if (!$beta) {
            return redirect()->route('login');
        }

        return app()->isDownForMaintenance()
            ? redirect(url(json_decode($secret)->secret))
            : redirect()->route('login');
    }
}
