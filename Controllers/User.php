<?php

namespace App\Controllers;
use App\Models\User;

class UserController extends BaseController
{

    public static function index()
    {
        $users = new User();
        self::loadView('/users', [
            'users' => $users->all()
        ]);
    }
    public static function show($id)
    {
        $user = new User();
        self::loadView('/user', [
            'user' => $user->find($id)
        ]);
    }
}
