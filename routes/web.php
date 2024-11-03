<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'user'])->name('user.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'admin'])->group(function(){
    //Page User
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class)->parameters(['categories' => 'category:slug']);
    Route::resource('posts', PostController::class)->parameters(['posts' => 'post:slug']);
    Route::resource('groups', GroupController::class)->parameters(['groups' => 'group:slug']);
    Route::resource('conferences', ConferenceController::class)->parameters(['conferences' => 'conference:slug']);
});

Route::get('/home', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('admin.dashboard');

require __DIR__.'/auth.php';
