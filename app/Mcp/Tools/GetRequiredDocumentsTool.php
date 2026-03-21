<?php

namespace App\Mcp\Tools;

use Laravel\Mcp\Tool;
use Laravel\Mcp\Tool\Attributes\Name;
use Laravel\Mcp\Tool\Attributes\Description;
use Laravel\Mcp\Tool\Attributes\InputSchema;
use App\Models\ScholarshipDocument;

#[Name('get_required_documents')]
#[Description('Fetch required documents for a scholarship scheme.')]

#[InputSchema([
    'scheme_name' => 'string|required'
])]

class GetRequiredDocumentsTool extends Tool
{
    public function handle(array $input): array
    {
        $documents = ScholarshipDocument::where('scheme_name', $input['scheme_name'])
            ->pluck('document_name');

        return [
            'documents' => $documents
        ];
    }
}
