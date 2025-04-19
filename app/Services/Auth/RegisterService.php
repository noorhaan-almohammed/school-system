<?php
namespace App\Services\Auth;

use App\Models\User;
use Exception;

class RegisterService{
    public function createUser(array $data){
        try{
            return User::create($data);
        }catch(Exception $e){
            throw new Exception('Error creating User '.$e->getMessage());
        }
    }
}
