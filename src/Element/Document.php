<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

class Document
{
    /** @var ElementInterface[] */
    private array $elements = [];

    public function addElement(ElementInterface $element): void
    {
        $this->elements[] = $element;
    }

    /**
     * @return ElementInterface[]
     */
    public function getElements(): array
    {
        return $this->elements;
    }
}
