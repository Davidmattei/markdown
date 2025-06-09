<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

trait ParentTrait
{
    private Elements $elements;

    public function getElements(): Elements
    {
        return $this->elements;
    }
}
