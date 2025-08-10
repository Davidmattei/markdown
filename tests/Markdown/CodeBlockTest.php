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
            'text inside' => ["    <a/>\n    *hi*\n\n    - one\n", "<pre><code>&lt;a/&gt;\n*hi*\n\n- one\n</code></pre>\n"],
            'keep paragraph' => ["Foo\n    bar\n\n", "<p>Foo\nbar</p>\n"],
            'paragraph after' => ["    foo\nbar\n", "<pre><code>foo\n</code></pre>\n<p>bar</p>\n"],
            'chunks' => ["    chunk1\n\n    chunk2\n  \n \n \n    chunk3\n", "<pre><code>chunk1\n\nchunk2\n\n\n\nchunk3\n</code></pre>\n"],
        ];
    }

    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }
}
