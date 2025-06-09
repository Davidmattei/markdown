<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

class Document implements ParentInterface, \JsonSerializable
{
    use ParentTrait;

    public function __construct()
    {
        $this->elements = new Elements($this);
    }

    public function jsonSerialize(): array
    {
        return [
            'type' => 'Document',
            'elements' => $this->elements,
        ];
    }
}
