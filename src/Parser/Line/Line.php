<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

use Fabricity\Markdown\Parser\Text;

class Line implements \Countable
{
    public Text $text;

    public function __construct(string $text = '')
    {
        $this->text = new Text($text);
    }

    public function __toString(): string
    {
        return (string) $this->text;
    }

    public function count(): int
    {
        return \count($this->text);
    }

    public function isNewLine(): bool
    {
        return $this->text->isEmpty();
    }

    public function offset(int $offset): Line
    {
        return new Line((string) $this->text->sub($offset));
    }

    public function prepend(string $prepend): Line
    {
        return new Line((string) $this->text->prepend($prepend));
    }

    public function trimPrefix(int $count = 1, string $char = ' '): Line
    {
        return new Line((string) $this->text->trimPrefix($count, $char));
    }

    public function trimStart(): Line
    {
        return new Line((string) $this->text->trimStart());
    }
}
