<?php

namespace App\Services;

use App\Events\UserRegistered;
use App\User;
use App\Exceptions\LoginInvalidException;
use App\Exceptions\UserHasBeenTaken;
use App\Exceptions\VerifyEmailTokenInvalidException;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Throw_;

class AuthService{

    public function login_user(string $email, string $password)
    {
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
    }

    public function register(string $first_name, string $last_name, string $email, string $password)
    {    
        $user = User::where('email', $email)->exists();
        if (!empty($user)){
            throw new UserHasBeenTaken();
        }

        $userPassword = bcrypt($password ?? Str::random(10));

        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => $userPassword,
            'confirmation_token' => Str::random(60),
        ]);

        event(new UserRegistered($user));
        
        return $user;
        
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('confirmation_token', $token)->first();   

        if(empty($user)) {
            throw new VerifyEmailTokenInvalidException();
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return $user;
    }
}