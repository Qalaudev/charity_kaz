<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GoogleChatController extends Controller
{
    public function handleMessage(Request $request)
    {
        $userMessage = $request->input('message');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . env('GOOGLE_API_KEY'), [
            'contents' => [[
                'role' => 'user',
                'parts' => [[ 'text' => $userMessage ]]
            ]],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 1000,
            ],
        ]);

        return $response->json();
    }
}
