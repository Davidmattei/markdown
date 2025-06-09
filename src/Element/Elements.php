<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

/** @implements \IteratorAggregate<ElementInterface> */
class Elements implements \IteratorAggregate, \JsonSerializable
{
    /** @var array<ElementInterface> */
    private array $elements = [];

    public function __construct(private readonly ParentInterface $parent)
    {
    }

    /** @return \Traversable<ElementInterface> */
    public function getIterator(): \Traversable
    {
        foreach ($this->elements as $element) {
            yield $element;
        }
    }

    public function jsonSerialize(): mixed
    {
        return $this->elements;
    }

    public function peek(): ?ElementInterface
    {
        $count = \count($this->elements);

        return $count > 0 ? $this->elements[$count - 1] : null;
    }

    public function push(ElementInterface $child): void
    {
        $child->setParent($this->parent);

        $this->elements[] = $child;
    }
}
