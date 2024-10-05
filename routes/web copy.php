<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostsController;
use App\Livewire\Posts\PostsCreate;
use App\Livewire\Posts\PostsList;
use App\Livewire\Posts\PostsUpdate;
use App\Http\Controllers\FrontController;



Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/{post:slug}', [FrontController::class, 'show'])->name('front.post');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.list');
    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('posts.list');
    Route::get('/dashboard/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/dashboard/posts/create', [PostsCreate::class, 'store'])->name('posts.store');
    Route::get('/dashboard/posts/{post:slug}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('/dashboard/posts/{post:slug}/update', [PostsUpdate::class, 'update'])->name('posts.update');
    Route::delete('/dashboard/posts/{post:slug}/delete', [PostsList::class, 'delete'])->name('posts.delete');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


require __DIR__.'/auth.php';