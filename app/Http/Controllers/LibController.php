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
        $categories = \DB::table('catagories')->get();
        return view('post.lib', compact('libraries', 'categories'));
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


    public function view($id)
    {
        $library = Library::findOrFail($id);
        $filePath = storage_path('app/public/' . $library->location);

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404);
        }

        // Return the file with appropriate headers
        return response()->file($filePath, [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => 'inline; filename="' . $library->name . '"'
        ]);
    }

    public function previewText($id)
    {
        $library = Library::findOrFail($id);
        $filePath = storage_path('app/public/' . $library->location);

        // Check if file exists and is a text file
        if (!file_exists($filePath) || !in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['txt'])) {
            abort(404);
        }

        // Read and return text content
        $content = file_get_contents($filePath);

        // Limit content for preview
        $maxLength = 100000;
        if (strlen($content) > $maxLength) {
            $content = substr($content, 0, $maxLength) . "\n\n... (preview truncated)";
        }

        return response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8'
        ]);
    }

    // Download file
    public function download($id)
    {
        $library = Library::findOrFail($id);
        $filePath = storage_path('app/public/' . $library->location);

        return response()->download($filePath, "{$library->name}." . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
