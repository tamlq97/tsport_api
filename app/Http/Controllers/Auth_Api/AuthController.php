<?php

namespace App\Http\Controllers\Auth_Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void

     */
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Emaill or password not valid.'], 401);
        }
        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        $loads = [];
        $user = auth('api')->user();
        if ($user->hasRole('customer')) {
            array_push($loads, 'customer');
            $user['avatarLink'] = asset('storage/customers/' . $user->id . '/');
        }
        if ($user->hasRole('supplier')) {
            array_push($loads, 'supplier');
            $user['logoLink'] = asset('storage/suppliers/' . $user->id . '/');
        }
        $user['userAvatarLink'] = asset('storage/users/' . $user->id . '/image/');
        return response()->json($user->load($loads));
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        // auth('api')->user()->token()->revoke();
        $cookie = Cookie::forget('_token');
        auth('api')->logout();


        return response()->json(['message' => 'Successfully logged out'])->withCookie($cookie);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        $cookie = $this->getCookieDetails($token);
        $user = auth('api')->user();

        $user['supplier'] = $user->supplier;
        $user['role_name'] = $user->roles->pluck('name');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'user' => $user,
            'expires_in' => auth('api')->factory()->getTTL() * 60
            // 'expires_in' => auth('api')->factory()->getTTL()
        ])
            ->cookie($cookie['name'], $cookie['value'], $cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']);
    }

    private function getCookieDetails($token): array
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => null,
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => true,
            'samesite' => false,
        ];
    }

    public function guard(): \Illuminate\Contracts\Auth\Guard|\Illuminate\Contracts\Auth\StatefulGuard
    {
        return auth()->guard('api');
    }
}
