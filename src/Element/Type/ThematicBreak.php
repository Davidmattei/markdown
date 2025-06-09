<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;

class ThematicBreak extends AbstractElement
{
    /** @return array{'type': 'ThematicBreak'} */
    public function jsonSerialize(): array
    {
        return ['type' => 'ThematicBreak'];
    }
}
