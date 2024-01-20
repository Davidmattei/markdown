<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\ElementInterface;

class Paragraph implements ElementInterface
{
    public function __construct(public string $text)
    {
    }

    public function toMarkdown(): string
    {
        return $this->text;
    }
}
