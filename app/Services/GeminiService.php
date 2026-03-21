<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GeminiService
{
    public function chat(string $message)
    {
        $response = Http::post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=' . env('GEMINI_API_KEY'),
            [
                "contents" => [
                    [
                        "parts" => [
                            ["text" => $message]
                        ]
                    ]
                ]
            ]
        );

        return $response->json();
    }
}
