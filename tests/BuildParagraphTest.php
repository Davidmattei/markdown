<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Fabricity\Markdown\MarkdownBuilder;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class BuildParagraphTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
              ['Markdown is a lightweight markup language'],
              ['  Markdown   is   a lightweight markup  language   '],
              ['Markdown is a lightweight markup language', "Markdown is a\nlightweight markup\nlanguage", ['max_line_length' => 20]],
              ['   Markdown   is a lightweight markup   language   ', "Markdown is a\nlightweight markup\nlanguage", ['max_line_length' => 20]],
              ["Markdown \nis a lightweight markup language", "Markdown\nis a lightweight markup language"],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testParagraph(string $text, string $expected = null, array $options = []): void
    {
        $expected ??= 'Markdown is a lightweight markup language';

        $markdownBuilder = MarkdownBuilder::create($options);
        $markdownBuilder->addParagraph($text);

        $this->assertEquals($expected, $markdownBuilder->build());
    }
}
