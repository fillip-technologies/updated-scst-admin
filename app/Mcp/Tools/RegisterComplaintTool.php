<?php

namespace App\Mcp\Tools;

use Laravel\Mcp\Tool;
use Laravel\Mcp\Tool\Attributes\Name;
use Laravel\Mcp\Tool\Attributes\Description;
use Laravel\Mcp\Tool\Attributes\InputSchema;
use Illuminate\Support\Str;
use App\Models\Complaint;

#[Name('register_complaint')]
#[Description('Register a complaint for district school support.')]

#[InputSchema([
    'student_name' => 'string|required|max:100',
    'mobile' => 'string|required|digits:10',
    'school_name' => 'string|required',
    'issue_category' => 'string|required',
    'description' => 'string|required|max:1000'
])]

class RegisterComplaintTool extends Tool
{
    public function handle(array $input): array
    {
        $complaintId = 'CMP-' . strtoupper(Str::random(6));

        Complaint::create([
            'complaint_id' => $complaintId,
            'student_name' => $input['student_name'],
            'mobile' => $input['mobile'],
            'school_name' => $input['school_name'],
            'issue_category' => $input['issue_category'],
            'description' => $input['description'],
            'status' => 'open'
        ]);

        return [
            'complaint_id' => $complaintId,
            'status' => 'Registered',
            'message' => 'Your complaint has been registered.'
        ];
    }
}
