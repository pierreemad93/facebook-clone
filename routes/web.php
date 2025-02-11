<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PostController as AdminPosts;

Route::middleware('auth')->group(function () {
    Route::get('/', HomeController::class)->name('homepage');
    Route::post('/post', [PostController::class, 'store'])->name('posts.store');
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
    Route::get('posts/search', [AdminPosts::class, 'search'])->name('posts.search');
    Route::resource('posts', AdminPosts::class);
});



require __DIR__ . '/auth.php';
