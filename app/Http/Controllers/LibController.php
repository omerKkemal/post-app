<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;
use Illuminate\Support\Facades\Storage;

class LibController extends Controller
{
    // Display authenticated user's library
    public function index()
    {
        $libraries = auth()->user()->library()->latest()->get();
        return view('post.lib', compact('libraries'));
    }

    // Display public library
    public function publicIndex()
    {
        $libraries = Library::latest()->get();
        return view('public_lib', compact('libraries'));
    }

    // Store new library file
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'document' => 'required|file|mimes:pdf,doc,docx,txt|max:10240', // 10MB max
        ]);

        try {
            $path = null;
            if ($request->hasFile('document')) {
                $path = $request->file('document')->store('libraries', 'public');
            }

            auth()->user()->library()->create([
                'name' => $request->name,
                'description' => $request->description,
                'location' => $path,
            ]);

            return response()->json(['success' => true, 'message' => 'File uploaded successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while uploading the file.'], 500);
        }
    }

    // Delete library file
    public function destroy($id)
    {
        $library = auth()->user()->library()->findOrFail($id);

        try {
            // Delete file from storage
            if ($library->location && Storage::disk('public')->exists($library->location)) {
                Storage::disk('public')->delete($library->location);
            }

            $library->delete();

            return response()->json(['success' => true, 'message' => 'File deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while deleting the file.'], 500);
        }
    }

    // Download file
    public function download($id)
    {
        $library = Library::findOrFail($id);

        if (!$library->location || !Storage::disk('public')->exists($library->location)) {
            abort(404, 'File not found');
        }

        return Storage::disk('public')->download($library->location, $library->name);
    }
}
