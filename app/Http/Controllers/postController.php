<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class postController extends Controller
{
    public function create()
    {
        return view('post.create');
    }
    public function store(){
        $data = request()-> validate([
            'another' => '',
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);
        auth()->user()->posts()->create($data);
        dd(request()->all());
    }
}
