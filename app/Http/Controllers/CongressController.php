<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\congress_leaders;

class CongressController extends Controller
{
    public function view()
    {
        $data = \DB::table('congress_leaders')->get();
        return view('post.congress', ['congress_leaders' => $data]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'bio' => 'nullable|string',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'media' => 'nullable|file|mimes:jpg,jpeg,png|max:10240',
        ]);

        if (!Auth::check()) {
            return redirect()->back()->with('error', 'You must be logged in to add a leader.');
        }

        try {
            // Handle file upload if present
            if ($request->hasFile('media')) {
                $data['photo_url'] = $request->file('media')->store('congress_leaders', 'public');
            }

            $data['user_id'] = Auth::id();
            $data['bio'] = $request->input('bio', '');

            // Use Eloquent for auto timestamps
            congress_leaders::create($data);

            return redirect()->back()->with('success', 'Congress leader added successfully.');
        } catch (\Exception $e) {
            \Log::error("Error storing congress leader: " . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to store congress leader.');
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        try {
            \DB::table('congress_leaders')->where('id', $id)->update($data);
            $message = "Congress leader updated successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error updating congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function destroy($id)
    {
        try {
            $congressLeader = \DB::table('congress_leaders')->where('id', $id)->first();

            if (!$congressLeader) {
                return redirect()->back()->with('error', 'Congress leader not found.');
            }

            \DB::table('congress_leaders')->where('id', $id)->delete();
            $message = "Congress leader deleted successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error deleting congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
