<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

readonly class Heading implements ElementInterface
{
    public function __construct(
        public int $level,
        public string $title,
    ) {
    }
}
