<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document;

use Fabricity\Markdown\Document\Block\Blocks;
use Fabricity\Markdown\Document\Block\ParentInterface;
use Fabricity\Markdown\Document\Block\ParentTrait;

class Document implements ParentInterface, \JsonSerializable
{
    use ParentTrait;

    public function __construct()
    {
        $this->blocks = new Blocks($this);
    }

    /** @return array{'type': 'Document', 'blocks': Blocks} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Document',
            'blocks' => $this->blocks,
        ];
    }
}
