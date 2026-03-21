<?php

namespace App\Mcp\Servers;

use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

#[Name('Fillipi')]
#[Version('0.0.1')]
#[Instructions('Instructions describing how to use the server and its features.')]
class Fillipi extends Server
{
    protected array $tools = [
        \App\Mcp\Tools\GetScholarshipInformationTool::class,
        \App\Mcp\Tools\GetRequiredDocumentsTool::class,
        \App\Mcp\Tools\RegisterComplaintTool::class,
        \App\Mcp\Tools\EscalateToHumanSupportTool::class,

    ];

    protected array $resources = [
        //
    ];

    protected array $prompts = [
        //
    ];
}
