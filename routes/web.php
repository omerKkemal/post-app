<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    try {
        $recent_harari_posts = Post::orderBy('created_at', 'desc')->take(3)->where('language', 'har')->get();
        $recent_english_posts = Post::orderBy('created_at', 'desc')->take(3)->where('language', 'eng')->get();
        $congress_members = DB::table('congress_leaders')->get();
        $messages = Post::where('category', 'message')->get();
        $law_posts = Post::where('category', 'law')->orderBy('created_at','desc')->take(5)->get();

        return view('welcome', compact('messages', 'congress_members', 'recent_harari_posts', 'recent_english_posts', 'law_posts'));
    } catch (\Exception $e) {
        \Log::error('Welcome page error: ' . $e->getMessage());

        // Return view with empty collections to prevent errors
        return view('welcome', [
            'messages' => collect(),
            'congress_members' => collect()
        ]);
    }
});
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/p/{language}', function ($language = 'har') {
    // Check if the language parameter is actually a valid language, not 'create'
    if (!in_array($language, ['har', 'eng'])) { // Add your valid languages
        abort(404);
    }

    $posts = Post::where('language', $language)
                 ->orderBy('created_at', 'desc')
                 ->take(10)
                 ->get();
    $catagories = \DB::table('catagories')->get();

    return view('postView', compact('posts', 'language', 'catagories'));
})->name('postView');



Route::get('/dashboard', function () {
    $subscriptions = \DB::table('subscriptions')->get();
    $numberOfSubscriptions = $subscriptions->count();

    $posts = Post::all();
    $numberOfPosts = $posts->count();
    $numberOfPostsByCategory = $posts->groupBy('category')->map->count();

    // Get posts grouped by date
    $postsByDate = $posts->groupBy(function($post) {
        return $post->created_at->format('Y-m-d');
    })->map->count();

    // Get subscriptions grouped by date
    $subscriptionsByDate = $subscriptions->groupBy(function($subscription) {
        return \Carbon\Carbon::parse($subscription->created_at)->format('Y-m-d');
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

    // Fill in missing dates with zero subscriptions
    $subscriptionsOverTime = [];
    if ($subscriptionsByDate->isNotEmpty()) {
        $startDate = $subscriptions->min('created_at')
            ? \Carbon\Carbon::parse($subscriptions->min('created_at'))->startOfDay()
            : now()->subDays(30)->startOfDay();
        $endDate = $subscriptions->max('created_at')
            ? \Carbon\Carbon::parse($subscriptions->max('created_at'))->startOfDay()
            : now()->startOfDay();

        $currentDate = $startDate;
        while ($currentDate <= $endDate) {
            $dateString = $currentDate->format('Y-m-d');
            $subscriptionsOverTime[$dateString] = $subscriptionsByDate[$dateString] ?? 0;
            $currentDate->addDay();
        }
    }

    return view('dashboard', compact(
        'numberOfPosts',
        'numberOfPostsByCategory',
        'postsOverTime',
        'numberOfSubscriptions',
        'subscriptions',
        'subscriptionsOverTime'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');


// Subscription Routes
Route::post('/subscribe', [App\Http\Controllers\SubScription::class, 'subscribe'])->name('subscribe');

// Public Library Route
Route::get('/public-library', [App\Http\Controllers\LibController::class, 'publicIndex'])->name('public.library');

// Post Routes
Route::get('/load-more-posts/{clickCount}/{language}', [PostController::class, 'loadMorePosts']);

// Profile and Post Management Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // FIX: Move specific routes BEFORE parameterized routes
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('post.store');
    Route::delete('/posts/{id}', [PostController::class, 'delete_post'])->name('posts.delete');
    // or if using resource routes:
    // Route::resource('posts', PostController::class);

    // This should come AFTER specific routes
    Route::get('/posts/{language}', [PostController::class, 'post'])->name('post.view');
    // Category Routes
    Route::get('/category', [App\Http\Controllers\CatagoryController::class, 'view'])->name('post.category');
    Route::post('/category/store', [App\Http\Controllers\CatagoryController::class, 'store'])->name('category.store');
    Route::delete('/category/destroy/{id}', [App\Http\Controllers\CatagoryController::class, 'destroy'])->name('category.destroy');
    Route::put('/category/update/{id}', [App\Http\Controllers\CatagoryController::class, 'update'])->name('category.update');

    // Congress Leaders Routes
    Route::get('/congress', [App\Http\Controllers\CongressController::class, 'view'])->name('congress.view');
    Route::post('/congress/store', [App\Http\Controllers\CongressController::class, 'store'])->name('congress.store');
    Route::put('/congress/update/{id}', [App\Http\Controllers\CongressController::class, 'update'])->name('congress.update');
    Route::delete('/congress/destroy/{id}', [App\Http\Controllers\CongressController::class, 'destroy'])->name('congress.destroy');

    // Library Routes
    Route::get('/library', [App\Http\Controllers\LibController::class, 'index'])->name('library.index');
    Route::post('/library/store', [App\Http\Controllers\LibController::class, 'store'])->name('library.store');
    Route::get('/library/view/{id}', [App\Http\Controllers\LibController::class, 'view'])->name('library.view');
    Route::get('/library/preview-text/{id}', [App\Http\Controllers\LibController::class, 'previewText'])->name('library.preview-text');
    Route::delete('/library/{id}', [App\Http\Controllers\LibController::class, 'destroy'])->name('library.destroy');
    Route::get('/download/{id}', [App\Http\Controllers\LibController::class, 'download'])->name('library.download');
});
require __DIR__.'/auth.php';
