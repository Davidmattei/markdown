<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ParagraphTest extends AbstractMarkdownTestCase
{
    #[DataProvider('markdownProvider')]
    public function testParagraph(string $markdown, string $html): void
    {
        $this->assertMarkdown($markdown, $html);
    }

    public static function markdownProvider(): array
    {
        return [
            'simple' => ["Small\n", "<p>Small</p>\n"],
            'with new line' => ["Small\n", "<p>Small</p>\n"],
            'multiline' => ["Line 1\nLin 2\n", "<p>Line 1\nLin 2</p>\n"],
            'spaces' =>  ["space   space  space \n", "<p>space   space  space </p>\n"],
        ];
    }
}
