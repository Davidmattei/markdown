<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

abstract class AbstractBlock implements BlockInterface, \JsonSerializable
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
