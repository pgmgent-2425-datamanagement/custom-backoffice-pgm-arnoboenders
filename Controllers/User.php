<?php

namespace App\Controllers;

use App\Models\Role;
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
        self::loadView('/users/user', [
            'user' => $user
        ]);
    }
    public static function create()
    {
        if (isset($_POST['first_name'])) {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id']
            ];
            $user = new User();
            $user->create($data);
            header('Location: /users');
            exit;
        } else {
            self::loadView('/users/create', [
                'roles' => Role::all()
            ]);
        }
    }

    public static function edit($id)
    {
        $user = User::find($id);
        if (isset($_POST['first_name'])) {
            $data = [
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'role_id' => $_POST['role_id']
            ];
            $user->update($id, $data);
            header('Location: /users');
            exit;
        } else {
            self::loadView('/users/edit', [
                'user' => $user,
                'roles' => Role::all()
            ]);
        }
    }
    public static function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        header('Location: /users');
        exit;
    }
}
