<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Mcp\Capability\Attribute\McpTool;
use Mcp\Capability\Attribute\Schema;
use Mcp\Schema\ToolAnnotations;

/**
 * Example MCP Tools
 *
 * This controller provides example MCP tools to demonstrate the capabilities.
 * Replace this with your own implementation after configuring the template.
 */
class ExampleController
{
    #[McpTool(
        name: 'add',
        description: <<<TEXT
            Adds two numbers together and returns the sum.
            This is a simple example tool to demonstrate MCP functionality.
            TEXT,
        annotations: new ToolAnnotations(
            title: 'Add Numbers',
            readOnlyHint: true
        )
    )]
    public function add(
        #[Schema(
            type: 'integer',
            description: 'The first number to add',
            minimum: -1000000,
            maximum: 1000000
        )]
        int $a,
        #[Schema(
            type: 'integer',
            description: 'The second number to add',
            minimum: -1000000,
            maximum: 1000000
        )]
        int $b
    ): array {
        return [
            'operation' => 'addition',
            'inputs' => ['a' => $a, 'b' => $b],
            'result' => $a + $b,
        ];
    }

    #[McpTool(
        name: 'greet',
        description: <<<TEXT
            Returns a personalized greeting message.
            Demonstrates string parameter handling and optional parameters.
            TEXT,
        annotations: new ToolAnnotations(
            title: 'Greeting Generator',
            readOnlyHint: true
        )
    )]
    public function greet(
        #[Schema(
            type: 'string',
            description: 'The name of the person to greet',
            minLength: 1,
            maxLength: 100
        )]
        string $name,
        #[Schema(
            type: 'string',
            description: 'Optional greeting style: formal, casual, or friendly',
            enum: ['formal', 'casual', 'friendly']
        )]
        ?string $style = 'casual'
    ): array {
        $greetings = [
            'formal' => "Good day, {$name}. It is a pleasure to meet you.",
            'casual' => "Hey {$name}! What's up?",
            'friendly' => "Hello {$name}! Nice to see you!",
        ];

        return [
            'name' => $name,
            'style' => $style ?? 'casual',
            'greeting' => $greetings[$style ?? 'casual'],
            'timestamp' => date('Y-m-d H:i:s'),
        ];
    }
}