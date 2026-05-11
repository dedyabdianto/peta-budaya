<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BeritaImageController extends Controller
{
    /**
     * Handle TinyMCE image upload.
     * Returns { location: url } for the editor to embed.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:5120',
        ]);

        $path = $request->file('file')->store('berita/content', 'public');

        return response()->json([
            'location' => asset('storage/'.$path),
        ]);
    }
}
