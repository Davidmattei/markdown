<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;
use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Element\Elements;
use Fabricity\Markdown\Element\ParentInterface;
use Fabricity\Markdown\Element\ParentTrait;

class BlockQuote extends AbstractElement implements ParentInterface
{
    use ParentTrait;

    public function __construct()
    {
        $this->elements = new Elements($this);
    }

    /** @return array{'type': 'BlockQuote', 'elements': ElementInterface[]} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'BlockQuote',
            'elements' => $this->elements,
        ];
    }
}
