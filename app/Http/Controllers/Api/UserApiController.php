<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserApiController extends ApiController
{
    protected $user;

    function __construct(UserService $user)
    {
        $this->user = $user;
    }

    public function index(Request $request)
    { 
        $users = $this->user->list($request->skip, $request->take);

        return $this->formatResponse($users);
    }
}
