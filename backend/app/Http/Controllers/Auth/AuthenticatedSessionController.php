<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function changeEmail(Request $request, int $id): JsonResponse|User
    {
        $request->validate([
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

//        $user = User::query()->where('id', $id)->first();
//
//        if(!isset($product)) {
//            $json = [
//                'status' => false,
//                'error' => "Unable to find requested user"
//            ];
//            return new JsonResponse($json, 404);
//        }

        $user = $request->user();

        $user->email = $request->email;

        $user->saveOrFail();

        return $user;
    }
}
