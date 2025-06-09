<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

abstract class AbstractElement implements ElementInterface, \JsonSerializable
{
    private ParentInterface $parent;

    public function getParent(): ParentInterface
    {
        return $this->parent;
    }

    public function setParent(ParentInterface $parent): void
    {
        $this->parent = $parent;
    }
}
