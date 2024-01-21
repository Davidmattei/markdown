<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Text;

class Heading implements ElementInterface
{
    public function __construct(
        private readonly int $size,
        private readonly string $text,
        private readonly bool $alternateSyntax
    ) {
    }

    public function toMarkdown(): string
    {
        $text = new Text($this->text);

        if ($this->alternateSyntax && 1 == $this->size) {
            return (string) $text->append(\PHP_EOL)->padRight('=', $text->length());
        }

        if ($this->alternateSyntax && 2 == $this->size) {
            return (string) $text->append(\PHP_EOL)->padRight('-', $text->length());
        }

        return (string) $text->prepend(' ')->padLeft('#', $this->size);
    }
}
