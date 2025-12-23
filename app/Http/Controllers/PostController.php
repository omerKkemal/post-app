<?php

/*
|--------------------------------------------------------------------------
| Post Controller
|--------------------------------------------------------------------------
| This controller handles the creation, storage, and retrieval of posts.
| It includes functionality for uploading media files and loading more posts via AJAX.
|--------------------------------------------------------------------------|
*/

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommunityMessage;
use App\Models\subscription;
use App\Models\Post;

class PostController extends Controller
{

    public function create()
    {
        \Log::info("Load More Request", [
            'loading' => 'create post page'
        ]);
        $category = \DB::table('catagories')->get();
        return view('post.create', compact('category'));
    }
    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required',
            'language' => 'required|string',
            'media' => 'nullable|array',
            'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:102400', // 100MB per file
            'Youtube_link' => 'nullable|url', // optional
        ]);
        try{
            // Handle multiple file uploads
            $mediaPaths = [];
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $path = $file->store('uploads/posts', 'public');
                    $mediaPaths[] = $path;
                }
            }
            if(!empty($data['Youtube_link'])){
                $embedUrl = $this->convertToEmbed($data['Youtube_link']);
                if($embedUrl){
                    $data['Youtube_link'] = $embedUrl;
                }
            }
            unset($data['media']); // Remove the file array from data
            $post = auth()->user()->posts()->create(array_merge($data, ['media_url' => !empty($mediaPaths) ? implode(',', $mediaPaths) : null]));

            \Log::info('Post created with category: ' . $data['category']);

            // Send email if category is community_message
            if ($data['category'] === 'message') {
                $subscribers = subscription::all();
                \Log::info('Sending community message emails to ' . $subscribers->count() . ' subscribers');
                foreach ($subscribers as $subscriber) {
                    \Log::info('Sending email to: ' . $subscriber->email);
                    try {
                        Mail::to($subscriber->email)->send(new CommunityMessage($post));
                        \Log::info('Email sent successfully to: ' . $subscriber->email);
                    } catch (\Exception $e) {
                        \Log::error('Failed to send email to ' . $subscriber->email . ': ' . $e->getMessage());
                    }
                }
            }

            return redirect('/posts/create')->with('success', 'Post created successfully!');


        }catch(\Exception $e){
            \Log::error('Post create error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while saving the post. Please try again.']);
        }
    }

    public function post(){
        // Get first 10 posts
        $posts_harari = Post::where('language', 'har')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();
        $posts_english = Post::where('language', 'eng')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();
        $posts_amharic = Post::where('language', 'am')
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

        $categories = \DB::table('catagories')->get();

        return view('post.view', compact('posts_harari', 'posts_english', 'posts_amharic', 'categories'));
    }

    public function loadMorePosts($clickCount)
    {
        try {
            $perPage = 10;

            /**
             * Frontend clarification:
             * - Initial load = page 1
             * - First "Load More" click = page 2
             * So if frontend sends clickCount = 1 for first click → page = clickCount + 1
             */
            $page = $clickCount + 1; // Fixed: Add 1 to clickCount to get the correct page

            \Log::info("Load More Request", [
                'clickCount' => $clickCount,
                'calculatedPage' => $page,
                'perPage' => $perPage
            ]);

            // Fetch paginated posts (ordered by latest)
            $posts_harari = Post::where('language', 'har')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            $posts_english = Post::where('language', 'eng')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            $posts_amharic = Post::where('language', 'am')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            $hasMore_harari = $posts_harari->hasMorePages();
            $hasMore_english = $posts_english->hasMorePages();
            $hasMore_amharic = $posts_amharic->hasMorePages();
            \Log::info("Pagination Result", [
                'currentPage harari' => $posts_harari->currentPage(),
                'currentPage english' => $posts_english->currentPage(),
                'currentPage amharic' => $posts_amharic->currentPage(),
                'postsCount harari' => $posts_harari->count(),
                'postsCount english' => $posts_english->count(),
                'postsCount amharic' => $posts_amharic->count(),
                'hasMore harari' => $hasMore_harari,
                'hasMore english' => $hasMore_english,
                'hasMore amharic' => $hasMore_amharic,
                'totalPosts harari' => $posts_harari->total(),
                'totalPosts english' => $posts_english->total(),
                'totalPosts amharic' => $posts_amharic->total(),
                'lastPage harari' => $posts_harari->lastPage(),
                'lastPage english' => $posts_english->lastPage(),
                'lastPage amharic' => $posts_amharic->lastPage(),
                'firstItem harari' => $posts_harari->firstItem(),
                'firstItem english' => $posts_english->firstItem(),
                'firstItem amharic' => $posts_amharic->firstItem(),
                'lastItem harari' => $posts_harari->lastItem(),
                'lastItem english' => $posts_english->lastItem(),
                'lastItem amharic' => $posts_amharic->lastItem(),
            ]);

            // Transform post data for JSON response
            $transformedPosts_harari = $posts_harari->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'category' => $post->category,
                    'media_url' => $post->media_url,
                    'Youtube_link' => $post->Youtube_link, // Make sure this is included
                    'created_at' => $post->created_at->toISOString(),
                    'updated_at' => $post->updated_at->toISOString(),
                ];
            });

            $transformedPosts_english = $posts_english->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'category' => $post->category,
                    'media_url' => $post->media_url,
                    'Youtube_link' => $post->Youtube_link, // Make sure this is included
                    'created_at' => $post->created_at->toISOString(),
                    'updated_at' => $post->updated_at->toISOString(),
                ];
            });

            $transformedPosts_amharic = $posts_amharic->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'category' => $post->category,
                    'media_url' => $post->media_url,
                    'Youtube_link' => $post->Youtube_link, // Make sure this is included
                    'created_at' => $post->created_at->toISOString(),
                    'updated_at' => $post->updated_at->toISOString(),
                ];
            });

            return response()->json([
                'success' => true,
                'posts_harari' => $transformedPosts_harari,
                'posts_english' => $transformedPosts_english,
                'posts_amharic' => $transformedPosts_amharic,
                'hasMore harari' => $hasMore_harari,
                'hasMore english' => $hasMore_english,
                'hasMore amharic' => $hasMore_amharic,
                'currentPage harari' => $posts_harari->currentPage(),
                'currentPage english' => $posts_english->currentPage(),
                'currentPage amharic' => $posts_amharic->currentPage(),
                'totalPosts harari' => $posts_harari->total(),
                'totalPosts english' => $posts_english->total(),
                'totalPosts amharic' => $posts_amharic->total(),
                'postsCount harari' => $posts_harari->count(),
                'postsCount english' => $posts_english->count(),
                'postsCount amharic' => $posts_amharic->count(),
                'clickCount' => $clickCount
            ]);

        } catch (\Exception $e) {
            \Log::error('Error in loadMorePosts: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error loading posts',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_post($id)
    {
        try {
            $post = Post::findOrFail($id);

            // Delete associated media files if exists
            if($post->media_url){
                $files = explode(',', $post->media_url);
                foreach($files as $file){
                    Storage::disk('public')->delete(trim($file));
                }
            }
            $post->delete();

            // Return JSON response for AJAX
            return response()->json([
                'success' => true,
                'message' => 'Post deleted successfully!'
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the post. Please try again.'
            ], 500);
        }
    }

    private function convertToEmbed($url)
    {
        $parsed = parse_url($url);
        parse_str($parsed['query'] ?? '', $query);

        if (!isset($query['v'])) return null;

        return "https://www.youtube.com/embed/{$query['v']}?autoplay=0&rel=0";
    }

}
