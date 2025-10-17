<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function create()
    {
        return view('post.create');
    }
    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'category' => 'required',
            'media' => 'nullable|file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:204800', // optional
        ]);
        try{
            // Save post
            $path = null;
            $is_saved = false;
            if ($request->hasFile('media')) {
                $path = $request->file('media')->store('uploads', 'public');
            }
            auth()->user()->posts()->create(array_merge($data, ['media_url' => $path]));

            return redirect('/post');


            dd($request->all());
        }catch(\Exception $e){
            echo $e->getMessage();
            return back()->withErrors(['error' => 'An error occurred while saving the post. Please try again.']);
        }
    }

    public function post(){
        // all posts in db and return all the posts
        $posts = Post::all();
        return view('post.view', compact('posts'));
    }

}
