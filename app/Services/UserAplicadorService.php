<?php

namespace App\Services;

use App\Http\Requests\UserAplicadorRequest;
use App\Models\UserAplicador;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserAplicadorService
{
   private UserAplicador $useraplicador;
   public function __construct(UserAplicador $useraplicador) 
   {
        $this->useraplicador = $useraplicador;
   }

   public function register (array $data) 
   {
     $data['password'] = Hash::make($data['password']);
     //dd($data);
     return $this->useraplicador->create($data);
   }

}
