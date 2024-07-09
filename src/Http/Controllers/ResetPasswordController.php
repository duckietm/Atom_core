<?php

namespace Atom\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('reset-password');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        return redirect()->route('reset-password');
    }
}
