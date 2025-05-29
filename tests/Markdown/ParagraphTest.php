<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ParagraphTest extends AbstractMarkdownTestCase
{
    #[DataProvider('markdownToHtml')]
    public function testHtml(string $markdown, string $html): void
    {
        $this->assertHtml($markdown, $html);
    }

    public static function markdownToHtml(): array
    {
        return [
            'double paragraphs' => ["First\ntext\n\nSecond\ntext\n", "<p>First\ntext</p>\n<p>Second\ntext</p>\n"],
            'simple' => ["Small\n", "<p>Small</p>\n"],
            'with new line' => ["Small\n", "<p>Small</p>\n"],
            'multiline' => ["Line 1\nLin 2\n", "<p>Line 1\nLin 2</p>\n"],
            'spaces' =>  ["space   space  space \n", "<p>space   space  space </p>\n"],
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
