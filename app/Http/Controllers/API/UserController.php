<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        UserRepository::store($request);
        return response()->json(['message' => 'Регистрация успешна']);
    }
    public function login(UserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        return response()->json([
            'message' => 'Авторизация успешна',
            'token' => substr($user->createToken("API TOKEN")->plainTextToken,2)
        ]);
    }
}
