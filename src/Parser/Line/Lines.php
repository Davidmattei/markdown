<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Lines
{
    public Cursor $cursor;

    /** @param Line[] $lines */
    private function __construct(
        private readonly array $lines,
    ) {
        $this->cursor = new Cursor(\count($this->lines));
    }

    public function current(): Line
    {
        return $this->lines[$this->cursor->getLine()]->offset($this->cursor->getChar());
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

    public function next(): ?Line
    {
        return $this->lines[$this->cursor->getLine() + 1];
    }

    /** @return Line[] */
    public function peekNext(int $count = 1): array
    {
        return \array_slice($this->lines, $this->cursor->getLine() + 1, $count);
    }

    /** @return Line[] */
    public function peekPrevious(int $count = 1): array
    {
        $start = \max(0, $this->cursor->getLine() - $count);

        return \array_slice($this->lines, $start, $this->cursor->getLine() - $start);
    }

    public function previous(): ?Line
    {
        return $this->lines[$this->cursor->getLine() - 1];
    }
}
