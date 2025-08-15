<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

interface BlockInterface
{
    public function getParent(): ParentInterface;

    public function setParent(ParentInterface $parent): void;
}
