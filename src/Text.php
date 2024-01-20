<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

class Text
{
    public function __construct(private string $text)
    {
    }

    public function __toString(): string
    {
        return $this->text;
    }

    public function maxLineLength(int $length = null): self
    {
        if (null === $length) {
            return $this;
        }

        $wrapped = [];
        foreach ($this->lines() as $line) {
            $wrapped[] = \wordwrap($line, $length);
        }

        return self::fromArray($wrapped);
    }

    public function sanitize(): self
    {
        $sanitized = [];
        foreach ($this->lines() as $line) {
            /** @var string $sanitizedLine */
            $sanitizedLine = \preg_replace('/\s+/', ' ', \trim($line));
            $sanitized[] = $sanitizedLine;
        }

        return self::fromArray($sanitized);
    }

    /**
     * @param string[] $text
     */
    private static function fromArray(array $text): self
    {
        return new self(\implode(\PHP_EOL, $text));
    }

    /**
     * @return \Generator<string>
     */
    private function lines(): \Generator
    {
        $separator = "\r\n";
        $line = \strtok($this->text, $separator);

        while (false !== $line) {
            yield $line;
            $line = \strtok($separator);
        }
    }
}
