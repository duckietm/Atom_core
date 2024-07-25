<?php

namespace Atom\Core\Http\Controllers;

use Atom\Core\Http\Requests\RegisterRequest;
use Atom\Core\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'username' => $request->get('username'),
            'password' => $request->get('password'),
            'mail' => $request->get('mail'),
            'look' => $request->get('look'),
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }
}
