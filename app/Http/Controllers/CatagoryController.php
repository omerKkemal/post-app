<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatagoryController extends Controller
{
    public function view()
    {
        $data = \DB::table('catagories')->get();
        return view('post.category', ['categories' => $data]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:catagories,name',
            'description' => 'nullable|string|max:500',
        ]);

        // Add the authenticated user's ID
        $data['user_id'] = Auth::id();

        try {
            \DB::table('catagories')->insert($data);
            $message = "Category added successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error adding category: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:catagories,name,' . $id,
            'description' => 'nullable|string|max:500',
        ]);

        try {
            \DB::table('catagories')->where('id', $id)->update($data);
            $message = "Category updated successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error updating category: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }

    public function destroy($id)
    {
        try {
            $category = \DB::table('catagories')->where('id', $id)->first();

            if (!$category) {
                return redirect()->back()->with('error', 'Category not found.');
            }

            \DB::table('catagories')->where('id', $id)->delete();
            $message = "Category deleted successfully.";
            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            $errorMessage = "Error deleting category: " . $e->getMessage();
            return redirect()->back()->with('error', $errorMessage);
        }
    }
}
