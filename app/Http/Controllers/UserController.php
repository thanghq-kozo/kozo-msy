<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->all();
    }

    public function getUserById($id)
    {
        return $this->userService->getUserById($id);
    }
}
