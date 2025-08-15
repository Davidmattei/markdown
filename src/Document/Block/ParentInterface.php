<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

interface ParentInterface
{
    public function getBlocks(): Blocks;
}
