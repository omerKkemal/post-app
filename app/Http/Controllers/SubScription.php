<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubScription extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email',
        ]);

        // Store the subscription in the database
        \DB::table('subscriptions')->insert([
            'email' => $request->input('email'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Thank you for subscribing!');
    }
}
