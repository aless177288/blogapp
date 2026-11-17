<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PostsController as AdminPostsController;
use App\Http\Controllers\Admin\PhotosController as AdminPhotosController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// Public Frontend Routes
Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('portafolio', [PagesController::class, 'portafolio'])->name('portafolio');
Route::get('blog/{post}', [PostsController::class, 'show'])->name('posts.show');
Route::get('category/{category}', [PostsController::class, 'category'])->name('category.show');
Route::post('send-telegram', [ContactController::class, 'sendMessage'])
    ->middleware('throttle:5,1')
    ->name('contact.send');

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Protected Admin Panel Routes
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('posts', [AdminPostsController::class, 'index'])->name('admin.posts.index');
    Route::get('posts/create', [AdminPostsController::class, 'create'])->name('admin.posts.create');
    Route::post('posts/store', [AdminPostsController::class, 'store'])->name('admin.posts.store');
    Route::get('posts/{post}', [AdminPostsController::class, 'edit'])->name('admin.posts.edit');
    Route::put('posts/{post}', [AdminPostsController::class, 'update'])->name('admin.posts.update');
    Route::delete('posts/{post}', [AdminPostsController::class, 'destroy'])->name('admin.posts.destroy');

    // Photo Management
    Route::post('posts/{post}/photos', [AdminPhotosController::class, 'store'])->name('admin.posts.photos.store');
    Route::delete('photos/{photo}', [AdminPhotosController::class, 'destroy'])->name('admin.photos.destroy');
});
