<?php

namespace App\Http\Controllers;

use App\Models\AccountApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function show(Request $request, AccountApplication $accountApplication, Media $media, $conversion = null)
    {
        // Only allow authenticated users
        if (!Auth::check()) {
            abort(403);
        }

        // Ensure the media belongs to the account application
        if ($media->model_type !== AccountApplication::class || $media->model_id !== $accountApplication->id) {
            abort(404);
        }

        $path = $media->getPath($conversion ?? '');
        $mimeType = File::mimeType($path);
        $stream = fopen($path, 'rb');
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $media->file_name . '"',
        ];
        return Response::stream(fn() => fpassthru($stream), 200, $headers);
    }
} 