<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block\Type;

use Fabricity\Markdown\Document\Block\AbstractBlock;

class ThematicBreak extends AbstractBlock
{
    /** @return array{'type': 'ThematicBreak'} */
    public function jsonSerialize(): array
    {
        return ['type' => 'ThematicBreak'];
    }
}
