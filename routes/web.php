<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

use Illuminate\Support\Facades\Auth;

// views
Route::get('/register', function () {
    if(!Auth::check()){
        return view('register');
    }else{
        return view('contacts.index');
    }
})->name('register');
Route::get('/', function () {
    if(!Auth::check()){
        return view('login');
    }else{
        return view('contacts.index');
    }
})->name('login');

// redirect unauthenticated users who visited this page
Route::middleware('auth')->group(function () {
    Route::resources([
        'contacts' => ContactController::class
    ]);
});

Route::post('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/userlogin', [UserController::class, 'login'])->name('userlogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
