<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        UserRepository::store($request);
        return response()->json(['message' => 'Регистрация успешна']);
    }
    public function login(UserLoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => false,
                'errors' => ['password' => ['Неправильный логин или пароль']],
            ], 401);
        }
        $user = Auth::user();
        return response()->json([
            'message' => 'Авторизация успешна',
            'token' => substr($user->createToken("API TOKEN")->plainTextToken,2)
        ]);
    }
}
