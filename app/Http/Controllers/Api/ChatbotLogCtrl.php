<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatbotLog;

class ChatbotLogCtrl extends Controller
{
    public function store(Request $request)
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey !== env('DIFY_LOG_API_KEY')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $request->validate([
            'user_input' => 'required|string',
        ]);

        ChatbotLog::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => $request->user_id,
            'user_input' => $request->user_input,
        ]);

        return response()->json(['message' => 'Log saved successfully'], 200);
    }
}
