<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        User::registerUser($request);
        return response()->json([
            'message' => 'Регистрация успешна',
        ], 200);
    }
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Авторизация успешна',
            'token' => substr($user->createToken("API TOKEN")->plainTextToken,2)
        ], 200);
    }
}
