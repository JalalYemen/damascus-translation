<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class QuoteFileUploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
        ]);

        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');

                // Generate unique filename
                $uniqueName = uniqid('quote_', true) . '.' . $file->getClientOriginalExtension();

                // Store file in the 'quotes' directory on 'r2' disk
                $path = $file->storeAs('quotes', $uniqueName, 'r2');

                if (!$path) {
                    throw new \Exception('Failed to store file to Cloudflare R2');
                }

                // Generate public URL
                $url = Storage::disk('r2')->url($path);

                if (empty($url)) {
                    throw new \Exception('Failed to generate public URL');
                }

                return response()->json([
                    'message' => 'File uploaded successfully',
                    'path' => $path,
                    'url' => $url,
                    'original_filename' => $file->getClientOriginalName(),
                ]);
            } catch (\Exception $e) {
                Log::error('File upload failed: ' . $e->getMessage());
                return response()->json(['message' => 'File upload failed: ' . $e->getMessage()], 500);
            }
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }
}
