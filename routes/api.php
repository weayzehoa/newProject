<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/', function(){
    if(env('APP_ENV') == 'production'){
        return response(null, 200)->header('Content-Type', 'text/plain');
    }else{
        return redirect()->to('docs');
    }
});

//前台API群組
use App\Http\Controllers\API\Web\V1\UserLoginController as UserLoginV1;

//後台API全組
use App\Http\Controllers\API\Admin\V1\AdminLoginController as AdminLoginV1;

Route::prefix('web')->name('webapi.')->group(function() {
    //第一版
    Route::prefix('v1')->name('v1.')->group(function() {
        Route::post('login', [UserLoginV1::class , 'login']);
        Route::post('logout', [UserLoginV1::class , 'logout']);
        Route::post('refresh', [UserLoginV1::class , 'refresh']);
        Route::post('register', [UserLoginV1::class , 'register']);
        // Route::post('sendVerifyCode', [UserLoginV1::class , 'sendVerifyCode']);
        // Route::post('confirmVerifyCode', [UserLoginV1::class , 'confirmVerifyCode']);
        // Route::post('forgetPassword', [UserLoginV1::class , 'forgetPassword']);

        if(env('APP_ENV') == 'local'){ //開發測試用. 正式機關閉
            Route::post('me', [UserLoginV1::class , 'me']);
        }
    });
});

//後台API群組
Route::prefix('admin')->name('adminapi.')->group(function() {
    //第一版
    Route::prefix('v1')->name('v1.')->group(function() {
        Route::post('login', [AdminLoginV1::class , 'login']);
        Route::post('logout', [AdminLoginV1::class , 'logout']);
        Route::post('refresh', [AdminLoginV1::class , 'refresh']);
        Route::post('register', [AdminLoginV1::class , 'register']);
        if(env('APP_ENV') == 'local'){ //開發測試用. 正式機關閉
            Route::post('me', [AdminLoginV1::class , 'me']);
        }
    });
});

//一般共用API
use App\Http\Controllers\API\UuidController as UUID;
Route::resource('uuid', UUID::class, ['only' => ['index']]);
