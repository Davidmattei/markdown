<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class CodeBlockTest extends AbstractMarkdownTestCase
{
    /** @return array<mixed> */
    public static function markdownToHtml(): array
    {
        return [
            'simple example' => ["    a simple\n      indented code block\n", "<pre><code>a simple\n  indented code block\n</code></pre>\n"],
        ];
    }

    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }
}
