<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Element\Paragraph;
use Fabricity\Markdown\Parser\Line\Line;

class Context
{
    private bool $parsed = false;

    public function __construct(
        public Line               $line,
        private readonly Document $document,
        public ?ElementInterface  $element = null,
    )
    {
    }

    public function newLine(): void
    {
        $this->element = null;
        $this->parsed = true;
    }

    public function updateElement(): void
    {
        if ($this->element instanceof Paragraph) {
            $this->element->content .= "\n" . $this->line->text;
            $this->parsed = true;
            return;
        }

        throw new \RuntimeException('Could not update line');
    }

    public function newElement(ElementInterface $element): void
    {
        $this->document->addElement($element);
        $this->element = $element;
        $this->parsed = true;
    }

    public function isParsed(): bool
    {
        return $this->parsed === true;
    }
}
