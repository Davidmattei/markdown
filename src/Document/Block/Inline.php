<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Document\Block;

class Inline
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function __toString(): string
    {
        return $this->text;
    }
}
