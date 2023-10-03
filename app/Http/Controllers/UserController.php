<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\UserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function userRegister(UserRequest $request)
    {
        $validated = $request->validated();

        $response = $this->userService->criausuario($validated);
        
        //dd($validated); 
        
        return response()->json(
            [
                'message' => 'Usuario registrado com sucesso!',
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/api/usuarios",
     *     tags={"Usuários"},
     *     summary="Obter todos os usuários cadastrados na base.",
     *     description="Retorna uma lista de todos os usuários cadastrados na base de dados.",
     *     @OA\Response(
     *         response=200,
     *         description="Sucesso. Retorna a lista de usuários cadastrados.",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#app/Http/Controllers/")
     *         )
     *     )
     * )
     */
    public function usuarioIndex(Request $request)
    {
        $response = $this->userService->getUsuarios();

        foreach ($response as $usuario) 
        {
            $usuarios[] = $usuario->getAttributes();
        } 
        
        return response()->json($usuarios);
    }
}


