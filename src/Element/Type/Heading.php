<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;

class Heading extends AbstractElement
{
    public function __construct(
        public int $level,
        public string $title,
    ) {
    }

    /** @return array{'type': 'Heading', 'level': string, 'title': string} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Heading',
            'level' => $this->level,
            'title' => $this->title,
        ];
    }
}
