<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

class Paragraph implements ElementInterface
{
    public function __construct(
        public string $content,
    ) {
    }
}
