<?php

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

// Route dasar
Route::get('/hello', function () {
    return "Hello";
});

Route::get('/world', function () {
    return "World";
});

Route::get('/', function () {
    return "Selamat Datang";
});

Route::get('/about', function () {
    return "NIM: 2341760021 - Nama: Muhammad Eksa";
});

// Route dengan parameter
Route::get('/user/{name}', function ($name) {
    return 'Nama saya ' . $name;
});

Route::get('/posts/{post}/comments/{comment}', function ($post, $comment) {
    return 'Pos ke-' . $post . " Komentar ke-" . $comment;
});

Route::get('/articles/{id}', function ($id) {
    return 'Halaman Artikel dengan ID ' . $id;
});

// Route dengan parameter opsional
Route::get('/user/{name?}', function ($name = 'John') {
    return 'Nama saya ' . $name;
});

// Route profile dengan nama yang benar
Route::get('/user/profile', [UserProfileController::class, 'show'])->name('user.profile');

// Redirect dan generate URL dengan nama yang benar
Route::get('/redirect-profile', function () {
    return redirect()->route('user.profile');
});

// Grouping Middleware
Route::middleware(['first', 'second'])->group(function () {
    Route::get('/', function () {
        // Uses first & second middleware...
    });

    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});

// Subdomain routing
Route::domain('{account}.example.com')->group(function () {
    Route::get('user/{id}', function ($account, $id) {
        return "Account: $account, User ID: $id";
    });
});

// Middleware auth untuk user, post, event
Route::middleware('auth')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});

// Prefix admin
Route::prefix('admin')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/post', [PostController::class, 'index']);
    Route::get('/event', [EventController::class, 'index']);
});

// Redirect
Route::redirect('/here', '/there');

// View route
Route::view('/welcome', 'welcome');
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
