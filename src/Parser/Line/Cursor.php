<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Cursor
{
    public function __construct(
        private readonly int $maxLines,
        private int $line = 0,
        private int $char = 0,
    ) {
    }

    public function advanceChar(int $count = 1): void
    {
        $this->char += $count;
    }

    public function advanceLine(): void
    {
        if ($this->line + 1 <= $this->maxLines) {
            ++$this->line;
        }

        $this->char = 0;
    }

    public function getChar(): int
    {
        return $this->char;
    }

    public function getLine(): int
    {
        return $this->line;
    }

    public function valid(): bool
    {
        return $this->line < $this->maxLines;
    }

    public function value(): string
    {
        return $this->line.':'.$this->char;
    }
}
