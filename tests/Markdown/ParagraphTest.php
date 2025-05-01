<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Markdown;

use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ParagraphTest extends AbstractMarkdownTestCase
{
    #[DataProvider('paragraphProvider')]
    public function testParagraph(string $markdown, string $html): void
    {
        $this->assertMarkdown($markdown, $html);
    }

    public static function paragraphProvider(): array
    {
        return [
            'simple' => ['Small', '<p>Small</p>'],
            'multiline' => ["Line 1\nLin 2", "<p>Line 1\nLin 2</p>"],
            'spaces' =>  ["space   space  space ", "<p>space   space  space </p>"],
        ];
    }
}
