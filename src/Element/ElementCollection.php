<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

/**
 * @implements \IteratorAggregate<Element>
 */
class ElementCollection implements \IteratorAggregate, \Countable
{
    /** @var list<Element> */
    private array $elements = [];

    public function add(Element $element): self
    {
        $this->elements[] = $element;
        \usort($this->elements, static fn (Element $a, Element $b) => $b->priority <=> $a->priority);

        return $this;
    }

    public function count(): int
    {
        return \count($this->elements);
    }

    /**
     * @return \Iterator<Element>
     */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->elements);
    }
}
