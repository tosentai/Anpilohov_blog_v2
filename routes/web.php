<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestTestController;
use App\Http\Controllers\Blog\PostController;
use App\Http\Controllers\Blog\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Blog\Admin\PostController as AdminPostController;
use App\Http\Controllers\DiggingDeeperController;

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

    $methods = ['index', 'edit', 'store', 'update', 'create', 'destroy'];
    Route::resource('categories', AdminCategoryController::class)
    ->only($methods)
        ->names('categories');

    Route::resource('posts', AdminPostController::class)
        ->except(['show'])
        ->names('posts');
});

Route::group(['prefix' => 'digging_deeper'], function () {
    Route::get('collections', [DiggingDeeperController::class, 'collections'])
        ->name('digging_deeper.collections');

    Route::get('prepare-catalog', [DiggingDeeperController::class, 'prepareCatalog'])
        ->name('digging_deeper.prepareCatalog');

    Route::get('process-video', [DiggingDeeperController::class, 'processVideo'])
        ->name('digging_deeper.processVideo');
});
