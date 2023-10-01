<?php

namespace App\Services;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
   private User $user;
   public function __construct(User $user) 
   {
        $this->user = $user;
   }

   public function criausuario (array $data) 
   {
        return $this->user->create($data);
   }

   public function getUsuarios() : Collection {

        return $this->user->get();
    
   }

}


