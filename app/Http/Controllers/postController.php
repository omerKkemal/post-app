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
            'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:204800', // optional
            'Youtube_link' => 'nullable|url', // optional
        ]);
        try{
            // Save post
            $path = null;
            if ($request->hasFile('media')) {
                $path = $request->file('media')->store('uploads', 'public');
            }
            if(!empty($data['Youtube_link'])){
                $embedUrl = $this->convertToEmbed($data['Youtube_link']);
                if($embedUrl){
                    $data['Youtube_link'] = $embedUrl;
                }
            }
            auth()->user()->posts()->create(array_merge($data, ['media_url' => $path]));

            return redirect('/posts/create')->with('success', 'Post created successfully!');


            dd($request->all());
        }catch(\Exception $e){
            echo $e->getMessage();
            return back()->withErrors(['error' => 'An error occurred while saving the post. Please try again.']);
        }
    }

    public function post($language = 'har'){
        // Get first 10 posts
        $posts = Post::where('language', $language)
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get();

        return view('post.view', compact('posts', 'language'));
    }

    public function loadMorePosts($clickCount, $language = 'har')
    {
        try {
            $perPage = 10;

            /**
             * Frontend clarification:
             * - Initial load = page 1
             * - First "Load More" click = page 2
             * So if frontend sends clickCount = 1 for first click → page = clickCount + 1
             */
            $page = $clickCount;

            // \Log::info("Load More Request", [
            //     'clickCount' => $clickCount,
            //     'calculatedPage' => $page,
            //     'perPage' => $perPage
            // ]);

            // Fetch paginated posts (ordered by latest)
            $posts = Post::where('language',$language)->orderBy('created_at', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);

            $hasMore = $posts->hasMorePages();

            // \Log::info("Pagination Result", [
            //     'currentPage' => $posts->currentPage(),
            //     'postsCount' => $posts->count(),
            //     'hasMore' => $hasMore,
            //     'totalPosts' => $posts->total(),
            //     'lastPage' => $posts->lastPage(),
            //     'firstItem' => $posts->firstItem(),
            //     'lastItem' => $posts->lastItem()
            // ]);

            // Transform post data for JSON response
            $transformedPosts = $posts->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'description' => $post->description,
                    'category' => $post->category,
                    'media_url' => $post->media_url,
                    'created_at' => $post->created_at->toISOString(),
                    'updated_at' => $post->updated_at->toISOString(),
                ];
            });

            return response()->json([
                'success' => true,
                'posts' => $transformedPosts,
                'hasMore' => $hasMore,
                'currentPage' => $posts->currentPage(),
                'totalPosts' => $posts->total(),
                'postsCount' => $posts->count(),
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

    private function convertToEmbed($url)
    {
        $parsed = parse_url($url);
        parse_str($parsed['query'] ?? '', $query);

        if (!isset($query['v'])) return null;

        return "https://www.youtube.com/embed/{$query['v']}?autoplay=0&rel=0";
    }

}
