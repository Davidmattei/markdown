<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Markdown;

use Fabricity\Markdown\Element\ElementInterface;

class Heading implements ElementInterface
{
    public const string REGEX = '/^(?<level>#{1,6})\s+(?<title>.*)/';

    private function __construct(
        public readonly int $level,
        public readonly string $title,
    ) {
    }

    /** @param array{ 'level': string, 'title': string } $match */
    public static function fromMatch(array $match): self
    {
        return new self(\strlen($match['level']), $match['title']);
    }

    public function toHtml(): string
    {
        return \vsprintf('<h%d>%s</h%d>', [
            $this->level,
            $this->title,
            $this->level,
        ]);
    }
}
