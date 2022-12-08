<?php

use App\Http\Controllers\Auth\UserForgetPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ConController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[UserController::class , 'login_page']);
Route::get('logout',[UserController::class , 'logout'])->name('log.out');
Route::post('store-user',[UserController::class , 'createUser']);
Route::post('login-user',[UserController::class , 'loginUser']);
Route::get('/http-api' ,[UserController::class , 'api']);


// Contact controller
Route::group(['middleware' => 'AuthMiddleware'],function ()
{
    Route::get('/contact-list',[ConController::class , 'view_con'])->name('view_contact');
    Route::post('/add-contact',[ConController::class , 'add_con'])->name('add.contact');
    Route::post('/del_con',[ConController::class , 'del_con'])->name('del.contact');   
});


// forget password controller


Route::get('/forget-password',[UserForgetPasswordController::class , 'send_otp_page'])->name('forget.password.page');
Route::post('/veriry_password',[UserForgetPasswordController::class , 'view'])->name('verify.otp');
Route::post('/change_password',[UserForgetPasswordController::class , 'change_password'])->name('change.password');

