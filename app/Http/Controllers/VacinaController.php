<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests\VacinaRequest;
use App\Models\Vacina;
use App\Services\VacinacaoService;

class VacinaController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    private VacinacaoService $vacinacaoService;

    public function __construct(VacinacaoService $vacinacaoService)
    {
        $this->vacinacaoService = $vacinacaoService;
    }

    public function vacinaRegister(VacinaRequest $request)
    {
        $validated = $request->validated();

        $response = $this->vacinacaoService->vacina($validated);
        
        //dd($validated); 
        
        return response()->json(
            [
                'message' => 'Vacina registrada com sucesso!',
            ]
        );
    }

    public function vacinaIndex(Request $request)
    {
        $response = $this->vacinacaoService->getUsuarioVacinas($request->email_usuario);

        foreach ($response as $vacina) 
        {
            $vacinas[] = $vacina->getAttributes();
        } 
        
        return response()->json($vacinas);
    }

}


