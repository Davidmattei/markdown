<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class HeadingTest extends AbstractMarkdownTestCase
{
    #[DataProvider('markdownProvider')]
    public function testHeading(string $markdown, string $html): void
    {
        $this->assertMarkdown($markdown, $html);
    }

    public static function markdownProvider(): array
    {
        return [
            'heading 1' => ['# Heading 1', "<h1>Heading 1</h1>\n"],
            'heading 2' => ['## Heading 2', "<h2>Heading 2</h2>\n"],
            'heading 3' => ['### Heading 3', "<h3>Heading 3</h3>\n"],
            'heading 4' => ['#### Heading 4', "<h4>Heading 4</h4>\n"],
            'heading 5' => ['##### Heading 5', "<h5>Heading 5</h5>\n"],
            'heading 6' => ['###### Heading 6', "<h6>Heading 6</h6>\n"],
            'no heading 7' => ["####### foo\n", "<p>####### foo</p>\n"],
        ];
    }
}
