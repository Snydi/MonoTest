<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory, HasApiTokens;
    public static function registerUser($request)
    {
        DB::table('users')->insert([
            'email' => $request->email,
            'password' => $request->password,
        ]);
    }
}
