<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class HeadingTest extends AbstractMarkdownTestCase
{
    /** @return array<mixed> */
    public static function markdownToHtml(): array
    {
        return [
            'heading 1' => ["# Heading 1\n", "<h1>Heading 1</h1>\n"],
            'heading 2' => ["## Heading 2\n", "<h2>Heading 2</h2>\n"],
            'heading 3' => ["### Heading 3\n", "<h3>Heading 3</h3>\n"],
            'heading 4' => ["#### Heading 4\n", "<h4>Heading 4</h4>\n"],
            'heading 5' => ["##### Heading 5\n", "<h5>Heading 5</h5>\n"],
            'heading 6' => ["###### Heading 6\n", "<h6>Heading 6</h6>\n"],
            'no heading 7' => ["####### foo\n", "<p>####### foo</p>\n"],
        ];
    }

    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }
}
