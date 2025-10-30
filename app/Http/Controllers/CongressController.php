<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        // Add the authenticated user's ID
        $data['user_id'] = Auth::id();

        try {
            \DB::table('congress_leaders')->insert($data);
            $message = "Congress leader added successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error adding congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
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
