<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NIDVerificationService
{
    public function verifyNID(string $nid, string $dob): bool
    {
        $rand = mt_rand(1, 100);
        if ($rand <= 70) {
            $url = 'https://run.mocky.io/v3/49b2e1b2-aa06-463d-9629-c1d2fc9c8645';
        } elseif ($rand <= 90) {
            $url = 'https://run.mocky.io/v3/f59b0ecd-3e2e-4cda-9d4c-5e23e7844d52';
        } else {
            $url = 'https://run.mocky.io/v3/7e31fa5b-102c-4987-82cb-68e2e8893f4a';
        }

        $response = Http::get($url, ['nid' => $nid, 'dob' => $dob]);

        if ($response->ok()) {
            $data = $response->json();
            if (isset($data['verified'])) {
                return (bool) $data['verified'];
            }
        }

        throw new \RuntimeException('Unexpected response', $response->status());
    }
}