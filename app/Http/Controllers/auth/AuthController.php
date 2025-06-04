<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Авторизация пользователя
     */
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {

            $user = Auth::user();


            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'success' => true,
                'token' => $token,
                'user' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Неверный email или пароль'
        ], 401);
    }

    /**
     * Выход пользователя из системы
     */
    /* public function logout(Request $request)
     {

 // Удаляем текущий токен авторизации
         $request->user()->currentAccessToken()->delete();

         return response()->json([
             'success' => true,
             'message' => 'Выход выполнен успешно'
         ]);
     }*/

    public function logout(Request $request)
    {
        Auth::guard('web')->logout(); // Пайдаланушыны сессиядан шығару

        $request->session()->invalidate(); // Сессияны жою
        $request->session()->regenerateToken(); // CSRF токенді жаңарту

        return response()->json([
            'success' => true,
            'message' => 'Выход выполнен успешно'
        ]);
    }

    /**
     * Отправка ссылки для сброса пароля
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

// Проверяем существование пользователя
        $user = User::where('email', $request->email)->first();
        if (!$user) {
// В целях безопасности мы возвращаем успешный ответ даже если пользователь не существует
            return response()->json([
                'success' => true,
                'message' => 'Если указанный email зарегистрирован в системе, вы получите письмо с инструкциями'
            ]);
        }

// Отправляем ссылку для сброса пароля
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Ссылка для сброса пароля отправлена на ваш email'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Не удалось отправить ссылку на сброс пароля'
        ], 500);
    }

    /**
     * Сброс пароля
     */
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка валидации',
                'errors' => $validator->errors()
            ], 422);
        }

// Сбрасываем пароль
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Пароль успешно сброшен'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Не удалось сбросить пароль',
            'error' => __($status)
        ], 500);
    }

    /**
     * Получение данных авторизованного пользователя
     */
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    }
}

?>
