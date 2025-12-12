<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibController extends Controller
{
    public function uploadLibrary(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'description' => 'nullable|string',
        ]);

        try {
            // Save post
            $path = null;
            if ($request->hasFile('document')) {
                $path = $request->file('document')->store('uploads', 'public');
            }
            auth()->user()->library()->create(array_merge($data, ['location' => $path]));
            return redirect()->back()->with('success', 'Library uploaded successfully!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while saving the library. Please try again.']);
        }
    }
}
