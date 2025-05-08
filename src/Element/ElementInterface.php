<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element;

use Fabricity\Markdown\Parser\Input;

interface ElementInterface
{
//    /** @param array<mixed> $match */
//    public static function fromMatch(array $match): self;
//
//    public function toHtml(): string;

    public static function match(Input $input): ?self;
}
