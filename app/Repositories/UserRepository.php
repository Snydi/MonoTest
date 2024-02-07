<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public static function store($request)
    {
        User::create([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}
