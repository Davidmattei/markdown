<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ThematicBreakTest extends AbstractMarkdownTestCase
{
    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }

    public static function markdownToHtml(): array
    {
        return [
            '3 stars' => ["***\n", "<hr />\n"],
            '3 scores' => ["---\n", "<hr />\n"],
            '3 underscore' => ["___\n", "<hr />\n"],
            '3 spaces' => ["   ****\n", "<hr />\n"],
            '4 spaces' => ["    ***\n", "<p>    ***</p>\n"],
            'not enough' => ["--\n", "<p>--</p>\n"],
            'more characters' => ["_____________________________________\n", "<hr />\n"],
            'spaces in between stars' => [" * * *\n", "<hr />\n"],
            'in paragraph' => ["Test\n---\nTest", "<p>Test</p>\n<hr />\n<p>Test</p>\n"],
        ];
    }
}
