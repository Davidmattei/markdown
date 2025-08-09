<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

interface ElementInterface
{
    public function getParent(): ParentInterface;

    public function setParent(ParentInterface $parent): void;
}
