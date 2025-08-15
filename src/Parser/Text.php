<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

readonly class Text implements \Countable
{
    public function __construct(private string $text)
    {
    }

    public function __toString(): string
    {
        return $this->text;
    }

    public function containsOnly(string ...$chars): bool
    {
        return \strspn($this->text, \implode('', $chars)) === \strlen($this->text);
    }

    public function count(): int
    {
        return \strlen($this->text);
    }

    public function isEmpty(): bool
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

    public function prepend(string $prepend): Text
    {
        return new Text($prepend.$this->text);
    }

    public function replace(string $search, string $replace): Text
    {
        return new Text(\str_replace($search, $replace, $this->text));
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

    public function sub(int $offset): Text
    {
        if (0 === $offset) {
            return new Text($this->text);
        }

        return new Text(\substr($this->text, $offset));
    }

    public function trim(): Text
    {
        return new Text(\trim($this->text));
    }

    public function trimPrefix(int $count = 1, string $char = ' '): Text
    {
        $i = 0;
        $length = \strlen($this->text);
        while ($i < $count && $i < $length && $this->text[$i] === $char) {
            ++$i;
        }

        return new Text(\substr($this->text, $i));
    }

    public function trimStart(): Text
    {
        return new Text(\ltrim($this->text, " \t"));
    }
}
