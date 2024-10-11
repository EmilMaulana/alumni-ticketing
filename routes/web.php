<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Livewire\Posts\PostsCreate;
use App\Livewire\Posts\PostsList;
use App\Livewire\Posts\PostsUpdate;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SitemapController;
use App\Http\Middleware\RoleCheck;


// Route::get('/login', function () {
//     return view('auth.login', [
//         'meta_desc' => '',
//         'title' => 'LOGIN'
//     ])->name('login'); // Menampilkan view yang akan memuat komponen Livewire
// });

Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/about', [FooterController::class, 'index']);
// Route login
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Route register
Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/profile', function () {
    return view('/dashboard/profile', [
        'title' => 'UPDATE PROFILE'
    ]);
})->name('profile');

Route::get('/posts', [FrontController::class, 'post'])->name('front.posts');
Route::get('/search', [FrontController::class, 'post'])->name('search.index');
// Route::get('/artikel/{slug}', [FrontController::class, 'post'])->name('post.show');

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/category', [FrontController::class, 'category'])->name('front.category');
Route::get('/{post:slug}', [FrontController::class, 'show'])->name('front.post');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('posts.list');
    Route::get('/dashboard/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/dashboard/posts/create', [PostsCreate::class, 'store'])->name('posts.store');
    Route::get('/dashboard/posts/{post:slug}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('/dashboard/posts/{post:slug}/update', [PostsUpdate::class, 'update'])->name('posts.update');
    Route::delete('/dashboard/posts/{post:slug}/delete', [PostsList::class, 'delete'])->name('posts.delete');
    Route::post('/ckeditor/upload', [ImageUploadController::class, 'upload'])->name('ckeditor.upload');
});

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.list');
});


// require __DIR__.'/auth.php';