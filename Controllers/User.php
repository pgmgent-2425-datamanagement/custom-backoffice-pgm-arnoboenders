<?php

namespace App\Controllers;
use App\Models\User;

class UserController extends BaseController
{

    public static function index()
    {
        $users = User::all();
        self::loadView('/users', [
            'users' => $users
        ]);
    }
    public static function show($id)
    {
        $user = User::find($id);
        self::loadView('/user', [
            'user' => $user
        ]);
    }
}
