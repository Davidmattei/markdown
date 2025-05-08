<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

class Input
{
    private int $cursor;
    private int $length;

    public function __construct(
        private string $text,
    )
    {
        $this->cursor = 0;
        $this->length = \strlen($text);
    }

    public function hasText(): bool
    {
        return $this->cursor < $this->length;
    }

    public function getLine(): string
    {
        $line = preg_split('/\r\n|\r|\n/', $this->text, 2)[0];

        if ('' === $line) {
            throw new \RuntimeException('No new line');
        }

        return $line;
    }

    public function offsetText(string $text): void
    {
        $this->offsetCursor(strlen($text));
    }

    public function offsetCursor(int $offset): void
    {
        $this->cursor += $offset;
        $this->text = substr($this->text, $this->cursor);
    }

    public function match(string $regex, array &$matches): bool
    {
        return 1 === \preg_match($regex, $this->text, $matches);
    }

    public function isNewLine(): bool
    {
        if (!preg_match('/^(?<newLine>\r\n|\r|\n)/', $this->text, $matches)) {
            return false;
        }

        $this->offsetText($matches['newLine']);

        return true;
    }
}
