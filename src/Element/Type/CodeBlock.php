<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;

class CodeBlock extends AbstractElement
{
    public function __construct(
        public string $content,
    ) {
    }

    /** @return array{'type': 'Code block', 'content': string} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Code block',
            'content' => $this->content,
        ];
    }
}
