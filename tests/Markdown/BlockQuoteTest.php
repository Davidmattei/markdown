<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class BlockQuoteTest extends AbstractMarkdownTestCase
{
    /** @return array<mixed> */
    public static function markdownToHtml(): array
    {
        return [
            'simple example' => ["> # Foo\n> bar\n> baz\n", "<blockquote>\n<h1>Foo</h1>\n<p>bar\nbaz</p>\n</blockquote>\n"],
            //            'omit tab or space' => ["># Foo\n>bar\n> baz\n", "<blockquote>\n<h1>Foo</h1>\n<p>bar\nbaz</p>\n</blockquote>\n"],
            //            'indentation up to 3 spaces' => ["   > # Foo\n   > bar\n > baz\n", "<blockquote>\n<h1>Foo</h1>\n<p>bar\nbaz</p>\n</blockquote>\n"]
        ];
    }

    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }
}
