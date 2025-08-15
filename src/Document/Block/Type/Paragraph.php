<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block\Type;

use Fabricity\Markdown\Document\Block\AbstractBlock;

class Paragraph extends AbstractBlock
{
    public function __construct(
        public string $content,
    ) {
    }

    /** @return array{'type': 'Paragraph', 'content': string} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Paragraph',
            'content' => $this->content,
        ];
    }
}
