<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block\Type;

use Fabricity\Markdown\Document\Block\AbstractBlock;
use Fabricity\Markdown\Document\Block\Inline;

class Heading extends AbstractBlock
{
    public Inline $title;

    public function __construct(
        public int $level,
        string $title,
    ) {
        $this->title = new Inline($title);
    }

    /** @return array{'type': 'Heading', 'level': int, 'title': string} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Heading',
            'level' => $this->level,
            'title' => (string) $this->title,
        ];
    }
}
