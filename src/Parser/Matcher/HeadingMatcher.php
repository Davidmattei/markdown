<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Parser\Context;

class HeadingMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $matches = [];
        if (!\preg_match('/^(?<level>#{1,6})\s+(?<title>.*)/', $context->line()->text, $matches)) {
            return;
        }

        $context
            ->newElement(new Heading(\strlen($matches['level']), $matches['title']))
            ->advance()
        ;
    }
}
