<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Document\Block\BlockInterface;
use Fabricity\Markdown\Document\Block\ParentInterface;
use Fabricity\Markdown\Document\Document;
use Fabricity\Markdown\Parser\Line\Line;
use Fabricity\Markdown\Parser\Line\Lines;

class Context
{
    public ?BlockInterface $currentBlock = null;
    public ParentInterface $parent;

    public function __construct(
        public readonly Lines $lines,
        Document $document,
    ) {
        $this->parent = $document;
    }

    public function finishBlock(): self
    {
        if ($this->currentBlock) {
            $this->parent = $this->currentBlock->getParent();
        }
        $this->currentBlock = null;
        $this->nextLine();

        return $this;
    }

    public function line(): Line
    {
        return $this->lines->current();
    }

    public function newBlock(BlockInterface $block): self
    {
        $this->parent->getBlocks()->push($block);
        $this->currentBlock = $block;

        if ($block instanceof ParentInterface) {
            $this->parent = $block;
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
