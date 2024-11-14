<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
                'password' => ['required', 'min:6']
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => new UserResource($user)
            ];

            return $this->sendResponse($data, 'Создание токена прошло успешно');

        } catch (Exception $error) {

            return $this->sendError('Не удалось создать токен', $error->getMessage());
        }
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return $this->sendError('Несанкционированный доступ', 'Не удалось аутентифицировать пользователя', 500);
            }

            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            $data = [
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => new UserResource($user)
            ];

            return $this->sendResponse($data, 'Аутентификация прошла успешно');

        } catch (Exception $error) {
            return $this->sendError(
                'Не удалось аутентифицировать пользователя',
                $error->getMessage()
            );
        }
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();

        return response()->noContent();
    }
}
