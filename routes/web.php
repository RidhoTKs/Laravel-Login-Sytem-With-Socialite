<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'index'])->name('register');
Route::post('/register/create', [UserController::class, 'register']);
Route::post('/register/login', function(Request $request) {
    return $request;
});

Route::get('/dashboard', function(){
    return view("dashboard");
});

Route::get('/facebook/redirect', [UserController::class, 'facebookRedirect']);
Route::get('/facebook/callback', [UserController::class, 'facebookCallback']);

Route::get('/google/redirect', [UserController::class, 'googleRedirect']);
Route::get('/google/callback', [UserController::class, 'googleCallback']);

Route::get('/twitter/redirect', [UserController::class, 'twitterRedirect']);
Route::get('/twitter/callback', [UserController::class, 'twitterCallback']);
