<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAplicadorRequest;
use App\Services\UserAplicadorService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class AuthController extends Controller
{
    
    private UserAplicadorService $userAplicadorService;
    
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserAplicadorService $userAplicadorService)
    {
        $this->middleware('auth:api', ['except' => ['login', 'aplicadorregister', 'refresh']]);
        $this->userAplicadorService = $userAplicadorService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Deslogado com sucesso.']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function aplicadorregister(UserAplicadorRequest $request)
    {
        $validated = $request->validated();

        $response = $this->userAplicadorService->register($validated);
        
        //dd($validated); 
        
        return response()->json(
            [
                'message' => 'Usuario Aplicador registrado com sucesso!',
            ]
        );
    }
    
}