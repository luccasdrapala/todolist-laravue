<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    private $authService;

    public function __construct(AuthService $authService){

        $this->authService = $authService;
    }
    
    public function login(AuthLoginRequest $request){
        
        $input = $request->validated();
        return $this->authService->login_user($input['email'], $input['password']);        
    }
}
