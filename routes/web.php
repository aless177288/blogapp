<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostsController;

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

Route::get('/', '\App\Http\Controllers\PagesController@home');
Route::get('portafolio', '\App\Http\Controllers\PagesController@portafolio');
Route::get('blog/{post}', '\App\Http\Controllers\PostsController@show')->name('posts.show');
Route::get('category/{category}', '\App\Http\Controllers\PostsController@category')->name('category.show');
Route::post('/send-telegram', '\App\Http\Controllers\ContactController@sendMessage')->name('contact.send');

// Route::post('/send-telegram', [\App\Http\Controllers\ContactController::class, 'sendMessage'])->name('contact.send');


Route::get('posts', function () {
   return App\Models\Post::all();
});

Route::group(['prefix' =>'admin','middleware'=>'auth'],
function(){
    Route::get('/','App\Http\Controllers\Admin\AdminController@index')->middleware('auth')->name('dashboard');
    Route::get('posts','App\Http\Controllers\Admin\PostsController@index')->name('admin.posts.index');
});

Route::get('admin/posts/create/','App\Http\Controllers\Admin\PostsController@create')->name('admin.posts.create');
Route::post('admin/posts/store/','App\Http\Controllers\Admin\PostsController@store')->name('admin.posts.store');
Route::get('admin/posts/{post}','App\Http\Controllers\Admin\PostsController@edit')->name('admin.posts.edit');
Route::put('admin/posts/{post}','App\Http\Controllers\Admin\PostsController@update')->name('admin.posts.update');
Route::delete('admin/posts/{post}', [PostsController::class, 'delete'])
     ->name('admin.posts.destroy');

Route::post('{post}/photos','App\Http\Controllers\Admin\PhotosController@store')
->name('admin.posts.photos.store');

Route::DELETE('photos/{photo}','App\Http\Controllers\Admin\PhotosController@destroy')
->name('admin.photos.destroy');


// Route::prefix('admin')->middleware('auth')->group(function () {
//     Route::get('/', 'Admin\AdminController@index')->name('dashboard');
//     Route::resource('posts', PostsController::class)->except('show')->names([
//         'create' => 'admin.posts.create',
//     ]);
    
// });


// Route::auth();
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//login Routes...
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', '\App\Http\Controllers\Auth\LoginController@login');


// Logout Routes...

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');