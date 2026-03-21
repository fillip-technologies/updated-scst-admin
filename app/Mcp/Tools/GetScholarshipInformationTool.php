<?php

namespace App\Mcp\Tools;

use Laravel\Mcp\Tool;
use Laravel\Mcp\Tool\Attributes\Name;
use Laravel\Mcp\Tool\Attributes\Description;
use Laravel\Mcp\Tool\Attributes\InputSchema;
use App\Models\Scholarship;

#[Name('get_scholarship_information')]
#[Description('Fetch verified scholarship information for SC/ST students in Bihar district schools.')]

#[InputSchema([
    'category' => 'string|required|in:SC,ST',
    'scheme_type' => 'string|required|in:pre_matric,post_matric'
])]

class GetScholarshipInformationTool extends Tool
{
    public function handle(array $input): array
    {
        $scholarship = Scholarship::where('category', $input['category'])
            ->where('scheme_type', $input['scheme_type'])
            ->first();

        if (!$scholarship) {
            return [
                'message' => 'No scholarship found. Please contact district office.'
            ];
        }

        return [
            'scheme_name' => $scholarship->scheme_name,
            'eligibility' => $scholarship->eligibility,
            'benefits' => $scholarship->benefits,
            'application_period' => $scholarship->application_period,
            'official_reference' => $scholarship->official_reference,
        ];
    }
}
