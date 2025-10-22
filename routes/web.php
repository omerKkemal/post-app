<?php

use App\Http\Controllers\postController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/p/{language}', function ($language = 'har') {
    // Check if the language parameter is actually a valid language, not 'create'
    if (!in_array($language, ['har', 'eng'])) { // Add your valid languages
        abort(404);
    }

    $posts = Post::where('language', $language)
                 ->orderBy('created_at', 'desc')
                 ->take(10)
                 ->get();

    return view('postView', compact('posts', 'language'));
});



Route::get('/dashboard', function () {
    $posts = Post::all();
    $numberOfPosts = $posts->count();
    $numberOfPostsByCategory = $posts->groupBy('category')->map->count();

    // Get posts grouped by date
    $postsByDate = $posts->groupBy(function($post) {
        return $post->created_at->format('Y-m-d');
    })->map->count();

    // Fill in missing dates with zero posts
    $postsOverTime = [];
    if ($postsByDate->isNotEmpty()) {
        $startDate = $posts->min('created_at')->startOfDay();
        $endDate = $posts->max('created_at')->startOfDay();

        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            $postsOverTime[$dateString] = $postsByDate[$dateString] ?? 0;
            $currentDate->addDay();
        }
    }

    return view('dashboard', compact('numberOfPosts', 'numberOfPostsByCategory', 'postsOverTime'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/load-more-posts/{clickCount}', [PostController::class, 'loadMorePosts']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // FIX: Move specific routes BEFORE parameterized routes
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');

    // This should come AFTER specific routes
    Route::get('/posts/{language}', [PostController::class, 'post'])->name('post.view');
});
require __DIR__.'/auth.php';
