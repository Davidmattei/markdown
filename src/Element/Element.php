<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

use Fabricity\Markdown\Element\Type\TypeInterface;

readonly class Element
{
    public function __construct(
        /** @var class-string<TypeInterface> */
        public string $typeClass,
        public string $regex,
        public int $priority = 0,
    ) {
    }
}
