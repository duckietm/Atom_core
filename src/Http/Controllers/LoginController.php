<?php

namespace Atom\Core\Http\Controllers;

use Atom\Core\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
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
            return redirect()->back()
                ->withInput()
                ->withErrors(['username' => 'The provided credentials are incorrect.']);
        }
        
        $user->update(['last_login' => time(), 'ip_current' => $request->ip()]);

        Auth::login($user);

        return redirect()->route('users.me');
    }
}
