<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Markdown;

use Fabricity\Markdown\Element\ElementInterface;

class ThematicBreak
{
    public const string REGEX = '/^(?:\s{0,3})?(?:[\*|\_|\-])*?(?:[\s|\t])*?(?:[\*|\_|\-])*?(?:[\s|\t])*?(?:[\*|\_|\-])*?(?:[\s|\t])*?\n/';

    public static function fromMatch(array $match): ElementInterface
    {
        return new self();
    }

    public function toHtml(): string
    {
        return '<hr />';
    }
}
