<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class TextTest extends AbstractMarkdownTestCase
{
    #[DataProvider('markdownProvider')]
    public function testText(string $markdown, string $html): void
    {
        $this->assertMarkdown($markdown, $html);
    }

    public static function markdownProvider(): array
    {
        return [
            'Test ASCII punctuation character may be backslash-escaped' => [
                "\\!\\\"\\#\\$\\%\\&\\'\\(\\)\\*\\+\\,\\-\\.\\/\\:\\;\\<\\=\\>\\?\\@\\[\\\\\\]\\^\\_\\`\\{\\|\\}\\~\n",
                "<p>!&quot;#$%&amp;'()*+,-./:;&lt;=&gt;?@[\\]^_`{|}~</p>\n"
            ],
            'Test hard line break' => [
                "foo\\\nbar\n",
                "<p>foo<br />\nbar</p>\n"
            ]
        ];
    }
}
