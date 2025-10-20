<?php

use App\Http\Controllers\postController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/p',function(){
    $posts = Post::all();
    return view('postView', compact('posts'));
});

Route::get('/dashboard', function () {
    $posts = Post::all();
    $numberOfPosts = $posts->count();
    $numberOfPostsByCategory = $posts->groupBy('category')->map->count();

    return view('dashboard', compact('numberOfPosts', 'numberOfPostsByCategory'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/posts', [PostController::class, 'post'])-> name('post.view');
    Route::get('/posts/create', [postController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [postController::class, 'store'])->name('post.store');
});

require __DIR__.'/auth.php';
