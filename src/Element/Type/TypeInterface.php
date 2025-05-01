<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

interface TypeInterface
{
    /** @param array<mixed> $match */
    public static function fromMatch(array $match): self;

    public function toHtml(): string;
}
