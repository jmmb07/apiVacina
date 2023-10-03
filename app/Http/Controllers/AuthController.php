<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAplicadorRequest;
use App\Services\UserAplicadorService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Api Vacina",
 *      description="Descricao",
 *      @OA\Contact(
 *          email="joao_borgato@hotmail.com"
 *      ),
 * )
 */



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
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Autenticação"},
     *     summary="Obter um JWT com base nas credenciais fornecidas.",
     *     description="Autentica um usuário e retorna um JSON Web Token (JWT) se as credenciais forem válidas.",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Dados de autenticação do usuário",
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="usuario@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="senha123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso. Retorna um JWT.",
     *         @OA\JsonContent(
     *             @OA\Property(property="access_token", type="string", description="Token de acesso JWT"),
     *             @OA\Property(property="token_type", type="string", description="Tipo de token (Bearer)"),
     *             @OA\Property(property="expires_in", type="integer", description="Tempo de expiração do token em segundos")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas. Falha na autenticação.",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", description="Mensagem de erro")
     *         )
     *     )
     * )
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