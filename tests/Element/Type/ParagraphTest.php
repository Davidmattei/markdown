<?php

declare(strict_types=1);

namespace Element\Type;

use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Tests\AbstractMarkdownTestCase;
use Fabricity\Markdown\Tests\SpecDataProvider;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

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
