<?php

namespace App\Services;

use App\Models\AccountApplication;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class NSFWVerificationService
{
    public function isSafe(string $filePath): bool
    {
        $host = config('services.nsfw.host');
        $key = config('services.nsfw.key');
        $endpoint = config('services.nsfw.endpoint');
        
        // @var \Illuminate\Http\Client\Response $response
        $response = Http::withHeaders([
            'x-rapidapi-host' => $host,
            'x-rapidapi-key' => $key,
        ])->attach(
            'image',
            fopen($filePath, 'r'),
            basename($filePath)
        )->post($endpoint);

        if ($response->ok()) {
            $data = $response->json();
            if (isset($data['unsafe']) && $data['unsafe']) {
                return false;
            }
        }
        
        return true;
    }
}