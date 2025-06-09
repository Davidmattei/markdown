<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;

class Paragraph extends AbstractElement
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
