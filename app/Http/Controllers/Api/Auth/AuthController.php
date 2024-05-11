<?php

namespace App\Http\Controllers\Api\Auth;

use App\Helpers\Traits\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Responses\ApiResponse as Response;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AuthController extends Controller
{
    use StorageHelper;

    /**
     * 
     */
    public function register(StoreUserRequest $request)
    {
        if (User::where('email', $request->email)->first()) {
            return Response::badRequest([
                'error-messages' => [
                    'email' => 'email already in use',
                ],
            ]);
        }

        $fileName = $request->hasFile('picture') ? $this->storeProfilePicture($request->file('picture')) : null;

        try {
            /** @var App\Models\User $newUser */
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'picture' => $fileName ?? null,
            ]);
        } catch (Throwable $e) {
            if ($fileName) {
                $this->deleteProfilePicture($fileName);
            }

            return Response::badRequest();
        }

        $tokenName = 'access_token';
        $abilities = ['default'];
        $expiresAt = now()->addMonth();

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = $newUser->createToken($tokenName, $abilities, $expiresAt);

        return Response::created([
            'access_token' => $token->plainTextToken,
        ], 'user created');
    }

    /**
     * 
     */
    public function login(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->credentials())) {
            return Response::unauthorized();
        }

        /** @var App\Models\User $user */
        $user = Auth::user();

        $user->tokens()->delete();

        $tokenName = 'access_token';
        $abilities = ['default'];
        $expiresAt = now()->addMonth();

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = $user->createToken($tokenName, $abilities, $expiresAt);

        return Response::ok([
            'access_token' => $token->plainTextToken,
        ], 'access token created');
    }

    /**
     * 
     */
    public function me(Authenticatable $user)
    {
        return $user;
    }
}
