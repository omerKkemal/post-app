<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CongressController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
        ]);

        try {
            DB::table('congress_leaders')->insert($data);
            $message = "Congress leader added successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error adding congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    public function update($id)
    {
        $data = request()->validate([
            'name' => 'sometimes|required|string|max:255',
            'position' => 'sometimes|required|string|max:255',
        ]);
        try {
            DB::table('congress_leaders')->where('id', $id)->update($data);
            $message = "Congress leader updated successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error updating congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    public function destroy($id)
    {
        $data = request()->validate([
            'id' => 'required|exists:congress,id',
        ]);
        if (!$data) {
            return redirect()->back()->with('error', 'Invalid congress leader ID.');
        }
        try {
            DB::table('congress_leaders')->where('id', $id)->delete();
            $message = "Congress leader deleted successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error deleting congress leader: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
    public function view()
    {
        $data = DB::table('congress_leaders')->get();
        return view('post.congress', ['congress_leaders' => $data]);
    }
}
