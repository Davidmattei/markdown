<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

readonly class Element
{
    public function __construct(
        /** @var class-string<ElementInterface> */
        public string $markdownClass,
        public string $regex,
        public int    $priority = 0,
    ) {
    }
}
