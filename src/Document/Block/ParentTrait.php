<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

trait ParentTrait
{
    private Blocks $blocks;

    public function getBlocks(): Blocks
    {
        return $this->blocks;
    }
}
