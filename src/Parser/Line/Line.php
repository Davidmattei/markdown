<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Line implements \Countable
{
    public function __construct(public string $text = '')
    {
    }

    public function containsOnly(string ...$chars): bool
    {
        return \strspn($this->text, \implode('', $chars)) === \strlen($this->text);
    }

    public function count(): int
    {
        return \strlen($this->text);
    }

    public function isNewLine(): bool
    {
        return '' === $this->text;
    }

    public function occursAtLeast(int $occurs, string ...$chars): bool
    {
        foreach ($chars as $char) {
            if (\substr_count($this->text, $char) >= $occurs) {
                return true;
            }
        }

        return false;
    }

    public function offset(int $offset): Line
    {
        if (0 === $offset) {
            return $this;
        }

        return new Line(\substr($this->text, $offset));
    }

    public function startsWith(string ...$chars): bool
    {
        foreach ($chars as $char) {
            if (\str_starts_with($this->text, $char)) {
                return true;
            }
        }

        return false;
    }

    public function trimPrefix(int $count = 1, string $char = ' '): Line
    {
        $i = 0;
        $length = \strlen($this->text);
        while ($i < $count && $i < $length && $this->text[$i] === $char) {
            ++$i;
        }

        return new Line(\substr($this->text, $i));
    }

    public function trimStart(): Line
    {
        return new Line(\ltrim($this->text, " \t"));
    }
}
