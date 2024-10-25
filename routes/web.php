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
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SitemapController;

require __DIR__.'/auth.php';

Route::get('/sitemap', [SitemapController::class, 'index']);
Route::get('/about', [FooterController::class, 'index']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth', 'verified')->name('dashboard');
Route::get('/dashboard/profile', function () {
    return view('dashboard.profile', [
        'title' => 'UPDATE PROFILE'
    ]);
})->middleware('auth', 'verified')->name('profile');

Route::get('/posts', [FrontController::class, 'post'])->name('front.posts');
Route::get('/search', [FrontController::class, 'post'])->name('search.index');

Route::get('/product/checkout/thank-you', [ProductController::class, 'success'])->name('product.checkout.success')->middleware(['auth', 'verified']);
Route::get('/product', [ProductController::class, 'frontProduct'])->name('front.product');
Route::get('/product/{product:slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('/product/checkout/{product:slug}', [ProductController::class, 'checkout'])->name('product.checkout')->middleware(['auth', 'verified']);
Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/category', [FrontController::class, 'category'])->name('front.category');
Route::get('/{post:slug}', [FrontController::class, 'show'])->name('front.post');

Route::post('/midtrans/callback', [ProductController::class, 'handleMidtransCallback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/posts', [PostsController::class, 'index'])->name('posts.list');
    Route::get('/dashboard/posts/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/dashboard/posts/create', [PostsCreate::class, 'store'])->name('posts.store');
    Route::get('/dashboard/posts/{post:slug}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::post('/dashboard/posts/{post:slug}/update', [PostsUpdate::class, 'update'])->name('posts.update');
    Route::delete('/dashboard/posts/{post:slug}/delete', [PostsList::class, 'delete'])->name('posts.delete');
    Route::get('/dashboard/product', [ProductController::class, 'index'])->name('product.list');
    Route::post('/ckeditor/upload', [ImageUploadController::class, 'upload'])->name('ckeditor.upload');
});

Route::middleware(['auth', 'verified' ,'role'])->group(function () {
    Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.list');
});


