<?php

namespace App\Services;

use App\Http\Requests\VacinaRequest;
use App\Models\Vacina;
use Illuminate\Database\Eloquent\Collection;

class VacinacaoService
{
   private Vacina $vacina;
   public function __construct(Vacina $vacina) 
   {
        $this->vacina = $vacina;
   }

   public function vacina (array $data) 
   {
        return $this->vacina->create($data);
   }

   public function getUsuarioVacinas(string $email) : Collection {

        return $this->vacina->where(['email_usuario'=>$email])->get();
    
   }

}


