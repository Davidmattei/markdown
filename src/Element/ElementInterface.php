<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

interface ElementInterface
{
    public function toMarkdown(): string;
}
