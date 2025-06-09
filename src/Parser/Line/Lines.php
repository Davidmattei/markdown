<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Lines
{
    private int $count;
    private int $index;

    /** @param Line[] $lines */
    private function __construct(
        private readonly array $lines,
    ) {
        $this->index = 0;
        $this->count = \count($this->lines);
    }

    public function advance(): void
    {
        if ($this->index + 1 <= $this->count) {
            ++$this->index;
        }
    }

    public function current(): Line
    {
        return $this->lines[$this->index];
    }

    public static function fromText(string $text): self
    {
        $lines = [];
        $input = \str_replace(["\r\n", "\r"], "\n", $text);

        $offset = 0;
        $length = \strlen($input);

        while ($offset < $length) {
            $pos = \strpos($input, "\n", $offset);

            if (false === $pos) {
                $lines[] = new Line(\substr($input, $offset));
                break;
            }

            $lines[] =  new Line(\substr($input, $offset, $pos - $offset));
            $offset = $pos + 1;
        }

        if ($length > 0 && "\n" === $input[$length - 1]) {
            $lines[] =  new Line();
        }

        return new self($lines);
    }

    public function getIndex(): int
    {
        return $this->index;
    }

    public function hasLines(): bool
    {
        return $this->index < $this->count;
    }

    public function next(): ?Line
    {
        return $this->lines[$this->index + 1];
    }

    /** @return Line[] */
    public function peekNext(int $count = 1): array
    {
        return \array_slice($this->lines, $this->index + 1, $count);
    }

    /** @return Line[] */
    public function peekPrevious(int $count = 1): array
    {
        $start = \max(0, $this->index - $count);

        return \array_slice($this->lines, $start, $this->index - $start);
    }

    public function previous(): ?Line
    {
        return $this->lines[$this->index - 1];
    }
}
