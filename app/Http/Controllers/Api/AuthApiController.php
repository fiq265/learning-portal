<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthApiController extends ApiController
{
    protected $auth;

    function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterUserRequest $request)
    {
        $auth = $this->auth->register($request->all());

        return $this->formatResponse($auth);
    }

    public function login(LoginUserRequest $request)
    {
        $auth = $this->auth->login($request->all());

        return $this->formatResponse($auth);
    }
}
