<?php

namespace Atom\Core\Http\Controllers;

use Hash;
use App\Events\UserLogin;
use Illuminate\View\View;
use Atom\Core\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = User::firstWhere('username', $request->get('username'));

        if (! $user || ! Hash::check($request->get('password'), $user->password)) {
            return redirect()
                ->route('login', ['error' => 1])
                ->withInput()
                ->withErrors(['username' => 'The provided credentials are incorrect.']);
        }

        if (app()->isDownForMaintenance() && $user->rank < 4) {
            return redirect()
                ->route('login', ['error' => 1])
                ->withInput();
        }

        $secret = @file_get_contents(storage_path('framework/down'));

        $user->update(['last_login' => time(), 'ip_current' => $request->ip()]);
        
        UserLogin::dispatch($user);

        Auth::login($user);

        return app()->isDownForMaintenance()
            ? redirect(url(json_decode($secret)->secret))
            : redirect()->route('users.me');
    }
}
