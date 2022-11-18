<?php

namespace App\Services;

use App\Exceptions\LoginInvalidException;

class AuthService{

    public function login_user(string $email, string $password){

        $login =[
            'email' => $email,
            'password' => $password
        ];

        if(!$token = auth()->attempt($login)){ //responsável por logar o usuário 
            
            throw new LoginInvalidException();
        }

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
        ];

        dd('Auth Service acessado com sucesso');
    }
}