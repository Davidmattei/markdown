<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Element\ParentInterface;
use Fabricity\Markdown\Parser\Line\Line;
use Fabricity\Markdown\Parser\Line\Lines;

class Context
{
    public ?ElementInterface $currentElement = null;
    public ParentInterface $parent;

    public function __construct(
        public readonly Lines $lines,
        Document $document,
    ) {
        $this->parent = $document;
    }

    public function finishElement(): self
    {
        if ($this->currentElement) {
            $this->parent = $this->currentElement->getParent();
        }
        $this->currentElement = null;
        $this->nextLine();

        return $this;
    }

    public function line(): Line
    {
        return $this->lines->current();
    }

    public function newElement(ElementInterface $element): self
    {
        $this->parent->getElements()->push($element);
        $this->currentElement = $element;

        if ($element instanceof ParentInterface) {
            $this->parent = $element;
        }

        return $this;
    }

    public function nextLine(): void
    {
        $this->lines->cursor->advanceLine();
    }

    public function remainingLine(Line $remaining): self
    {
        $remainingChar = \count($this->lines->current()) - \count($remaining);
        $this->lines->cursor->advanceChar($remainingChar);

        return $this;
    }
}
