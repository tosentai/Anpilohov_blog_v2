<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\Blog\Admin\CategoryController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('rest', RestTestController::class)->names('restTest');

Route::group([
    'namespace' => 'App\Http\Controllers\Blog',
    'prefix' => 'blog'
], function () {
    Route::resource('posts', PostController::class)->names('blog.posts');
});

$groupData = [
    'prefix' => 'admin/blog',
    'as' => 'blog.admin.',
];
Route::group($groupData, function () {
    $methods = ['index','edit','store','update','create',];
    Route::resource('categories', CategoryController::class)
        ->only($methods)
        ->names('categories');

    Route::resource('posts', AdminPostController::class)
        ->except(['show'])
        ->names('posts');
});
