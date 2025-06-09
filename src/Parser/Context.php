<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Parser\Line\Line;
use Fabricity\Markdown\Parser\Line\Lines;

class Context
{
    public ?ElementInterface $element = null;

    public function __construct(
        public readonly Lines $lines,
        private readonly Document $document,
    ) {
    }

    public function advanceNextLine(): void
    {
        $this->lines->advance();
    }

    public function clearElement(): self
    {
        $this->element = null;

        return $this;
    }

    public function line(): Line
    {
        return $this->lines->current();
    }

    public function newElement(ElementInterface $element): self
    {
        $this->document->getElements()->push($element);
        $this->element = $element;

        return $this;
    }
}
