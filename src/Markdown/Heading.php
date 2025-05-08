<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Markdown;

use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Parser\Input;

class Heading implements ElementInterface
{
    public const string REGEX = '/^(?<level>#{1,6})\s+(?<title>.*)/';

    private function __construct(
        public readonly int $level,
        public readonly string $title,
    ) {
    }

    public static function match(Input $input): ?self
    {
        $matches = [];
        if (!$input->match(self::REGEX, $matches)) {
            return null;
        }

        $input->offsetText($matches[0]);

        return new self(\strlen($matches['level']), $matches['title']);
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
