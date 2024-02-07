<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public static function store($request)
    {
        User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
