<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block\Type;

use Fabricity\Markdown\Document\Block\AbstractBlock;
use Fabricity\Markdown\Document\Block\Blocks;
use Fabricity\Markdown\Document\Block\ParentInterface;
use Fabricity\Markdown\Document\Block\ParentTrait;

class BlockQuote extends AbstractBlock implements ParentInterface
{
    use ParentTrait;

    public function __construct()
    {
        $this->blocks = new Blocks($this);
    }

    /** @return array{'type': 'BlockQuote', 'blocks': Blocks} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'BlockQuote',
            'blocks' => $this->blocks,
        ];
    }
}
