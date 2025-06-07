<?php

use App\Events\MessageSent;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\getHelpController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileUserController;
use App\Mail\VerificationCodeMail;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/register',[RegisterController::class,'registerStore'])->name('registerStore');
//Route::post('/login',[LoginController::class,'loginStore'])->name('loginStore');
Route::post('/login',[AuthController::class,'login'])->name('loginStore');
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout'])->name('logout');


Route::get('/test-login', function () {
    $credentials = [
        'email' => 'aaleuetdinov@gmail.com',
        'password' => 'Zamira1975!' // Замени на реальный пароль
    ];

    if (Auth::attempt($credentials)) {
        return 'Логин успешен!';
    }

    return 'Ошибка логина!';
});


Route::get('/group',[GroupController::class,'index'])->name('groups.index');
Route::post('/create/group',[GroupController::class,'store'])->name('store.group');
Route::get('/groups/{id}',[GroupController::class,'show'])->name('group.show');

Route::post('/gethelp',[getHelpController::class,'getHelp'])->name('getHelp');
Route::get('/get-helps',[getHelpController::class,'getOneHelp'])->name('getOneHelp');
Route::get('/user',[ProfileUserController::class,'authUser'])->name('user.index');

Route::middleware('auth:sanctum')->post('/profile', [ProfileUserController::class, 'store'])->name('profileStore');

Route::post('/contact', [ContactController::class, 'sendMail'])->name('sendMail');

Route::post('/send-code', [RegisterController::class, 'sendVerificationCode']);
Route::post('/verify-code', [RegisterController::class, 'verifyCode']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users-all', [ChatController::class, 'getAllUsers']);
    Route::get('/users-all-dddd', [ProfileUserController::class, 'authUser']);
    Route::post('/message/{friendId}', [ChatController::class, 'sendMessage']);
    Route::get('/message/{friendId}', [ChatController::class, 'getMessages']);
});

// Broadcast authorization routes
Route::middleware(['auth:sanctum'])->group(function () {
    Broadcast::channel('chat{userId}', function ($user, $userId) {
        return (int) $user->id === (int) $userId;
    });
});

Route::get('/test-event', function () {
    $message = new Message([
        'id' => 999,
        'sender_id' => 1,
        'receiver_id' => 2,
        'message' => 'Тест хабарлама',
        'created_at' => now(),
    ]);

    broadcast(new MessageSent($message));

    return 'OK';
});
// Маршруты для интерфейса новостей
Route::get('/news', function () {
    return view('news.index');
})->name('news.index');


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
