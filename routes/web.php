<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::group(['namespace' => 'Admin','middleware' => ['admin', 'auth'], 'prefix' => 'admin'], function () {
//    Route::get('/admin', function () {
//        return view('admin');
//    })->name('admin_main');

    Route::get('/admin', [UserController::class, 'count'])->name('admin_main');

    Route::get('/personal', [UserController::class, 'personal_profile']);

    Route::group(['namespace' => 'Category'], function () {
    Route::get('/category', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/{category}/update', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/category/{category}', [CategoryController::class, 'show_category'])->name('category.show_category');
    });

    Route::group(['namespace' => 'Tag'], function () {
        Route::get('/tag', [TagController::class, 'show'])->name('tag.show');
        Route::post('/tag/create', [TagController::class, 'create'])->name('tag.create');
        Route::post('/tag/{tag}/update', [TagController::class, 'update'])->name('tag.update');
        Route::delete('/tag/{tag}/delete', [TagController::class, 'delete'])->name('tag.delete');
        Route::get('/tag/{tag}', [TagController::class, 'show_category'])->name('tag.show_category');
    });

    Route::group(['namespace' => 'Post'], function () {
        Route::get('/post', [PostController::class, 'show'])->name('post.show');
        Route::post('/post/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/post/{post}/update', [PostController::class, 'update'])->name('post.update');
        Route::delete('/post/{post}/delete', [PostController::class, 'delete'])->name('post.delete');
        Route::get('/post/{post}', [PostController::class, 'show_category'])->name('post.show_category');
    });

    Route::group(['namespace' => 'User'], function () {
        Route::get('/user', [UserController::class, 'show'])->name('user.show');
        Route::post('/user/create', [UserController::class, 'create'])->name('user.create');
//        Route::post('/user/{user}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}/delete', [UserController::class, 'delete'])->name('user.delete');
        Route::get('/user/{user}', [UserController::class, 'personal_profile'])->name('user.personal_profile');
    });

    Route::group(['namespace' => 'Likes'], function () {
        Route::post('/post/{post}/like', [PostLikeController::class, 'Like'])->name('posts.like');
    });

    Route::group(['namespace' => 'Comments'], function () {
        Route::post('/post/{post}/comment', [PostCommentController::class, 'comment'])->name('posts.comment');
    });



});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
