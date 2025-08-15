<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

/** @implements \IteratorAggregate<BlockInterface> */
class Blocks implements \IteratorAggregate, \JsonSerializable
{
    /** @var array<BlockInterface> */
    private array $blocks = [];

    public function __construct(private readonly ParentInterface $parent)
    {
    }

    /** @return \Traversable<BlockInterface> */
    public function getIterator(): \Traversable
    {
        foreach ($this->blocks as $block) {
            yield $block;
        }
    }

    /**
     * @return array<mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->blocks;
    }

    public function peek(): ?BlockInterface
    {
        $count = \count($this->blocks);

        return $count > 0 ? $this->blocks[$count - 1] : null;
    }

    public function push(BlockInterface $child): void
    {
        $child->setParent($this->parent);

        $this->blocks[] = $child;
    }
}
