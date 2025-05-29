<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Line
{
    public function __construct(public string $text = "")
    {
    }

    public function trimPrefix(int $count, string $char = ' '): Line
    {
        $i = 0;
        $length = strlen($this->text);
        while ($i < $count && $i < $length && $this->text[$i] === $char) {
            $i++;
        }

        return new Line(substr($this->text, $i));
    }

    public function startsWith(string ...$chars): bool
    {
        foreach ($chars as $char) {
            if (str_starts_with($this->text, $char)) {
                return true;
            }
        }

        return false;
    }

    public function occurs(int $minCount, string ...$chars): bool
    {
        foreach ($chars as $char) {
            if (substr_count($this->text, $char) >= $minCount) {
                return true;
            }
        }

        return false;
    }

    public function containsOnly(string ...$chars): bool
    {
        return strspn($this->text, \implode('', $chars)) === strlen($this->text);
    }

    public function isNewLine(): bool
    {
        return $this->text === "";
    }
}
