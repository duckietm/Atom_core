<?php

namespace Atom\Core\Http\Controllers;

use Atom\Core\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AvatarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $user = User::firstWhere('username', $request->get('username'));

        if (! $user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        return response()->json($user->only('id', 'username', 'look'));
    }
}
