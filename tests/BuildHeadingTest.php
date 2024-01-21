<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Fabricity\Markdown\MarkdownBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BuildHeadingTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            ['h1', 'Heading', '# Heading'],
            ['h2', 'Heading', '## Heading'],
            ['h3', 'Heading', '### Heading'],
            ['h4', 'Heading', '#### Heading'],
            ['h5', 'Heading', '##### Heading'],
            ['h6', 'Heading', '###### Heading'],
            ['h1', 'Heading', "Heading\n=======", ['header_alternate_syntax' => true]],
            ['h2', 'Heading', "Heading\n-------", ['header_alternate_syntax' => true]],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testHeading(string $method, string $text, string $expected, array $options = []): void
    {
        $markdownBuilder = new MarkdownBuilder($options);
        $markdownBuilder = \call_user_func([$markdownBuilder, $method], $text);

        $this->assertEquals($expected, $markdownBuilder->build());
    }
}
