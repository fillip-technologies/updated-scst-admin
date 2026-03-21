<?php

namespace App\Mcp\Tools;

use Laravel\Mcp\Tool;
use Laravel\Mcp\Tool\Attributes\Name;
use Laravel\Mcp\Tool\Attributes\Description;
use Laravel\Mcp\Tool\Attributes\InputSchema;
use Illuminate\Support\Str;
use App\Models\SupportTicket;

#[Name('escalate_to_human')]
#[Description('Escalate issue to district education officer.')]

#[InputSchema([
    'student_name' => 'string|required',
    'mobile' => 'string|required|digits:10',
    'school_name' => 'string|required',
    'reason' => 'string|required'
])]

class EscalateToHumanSupportTool extends Tool
{
    public function handle(array $input): array
    {
        $ticketId = 'TKT-' . strtoupper(Str::random(6));

        SupportTicket::create([
            'ticket_id' => $ticketId,
            'student_name' => $input['student_name'],
            'mobile' => $input['mobile'],
            'school_name' => $input['school_name'],
            'reason' => $input['reason'],
            'status' => 'open'
        ]);

        return [
            'ticket_id' => $ticketId,
            'status' => 'Escalated',
            'message' => 'Your request has been escalated to district officer.'
        ];
    }
}
