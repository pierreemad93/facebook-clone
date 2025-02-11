<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//profile 
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::prefix('admin')->middleware('auth')->as('admin.')->group(function () {
    //post
    Route::get('posts/search', [PostController::class, 'search'])->name('posts.search');
    Route::resource('posts', PostController::class);
});



require __DIR__ . '/auth.php';
