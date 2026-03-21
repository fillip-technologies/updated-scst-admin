<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeminiService;
use Laravel\Mcp\Facades\Mcp;

class ChatController extends Controller
{
    public function handle(Request $request)
    {
        $message = $request->message;

        $gemini = new GeminiService();

        // Get MCP tools
        $mcpTools = Mcp::server('Fillipi')->tools();

        // Format tools for Gemini
        $formattedTools = $this->formatToolsForGemini($mcpTools);

        $response = $gemini->chatWithTools($message, $formattedTools);

        // Check if Gemini wants to call a function
        if (isset($response['candidates'][0]['content']['parts'][0]['functionCall'])) {

            $functionCall = $response['candidates'][0]['content']['parts'][0]['functionCall'];

            $toolResult = Mcp::server('Fillipi')
                ->callTool(
                    $functionCall['name'],
                    $functionCall['args']
                );

            return response()->json([
                'reply' => json_encode($toolResult, JSON_PRETTY_PRINT)
            ]);
        }

        return response()->json([
            'reply' => $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No response'
        ]);
    }

    private function formatToolsForGemini($mcpTools)
    {
        $formatted = [];

        foreach ($mcpTools as $tool) {
            $formatted[] = [
                "functionDeclarations" => [
                    [
                        "name" => $tool['name'],
                        "description" => $tool['description'],
                        "parameters" => [
                            "type" => "object",
                            "properties" => []
                        ]
                    ]
                ]
            ];
        }

        return $formatted;
    }
}
