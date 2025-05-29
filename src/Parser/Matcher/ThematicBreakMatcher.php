<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\ThematicBreak;
use Fabricity\Markdown\Parser\Context;

class ThematicBreakMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line->trimPrefix(3);

        if (!$line->startsWith('*', '-', '_')
            || !$line->containsOnly('*', '-', '_', ' ')
            || !$line->occurs(3, '*', '-', '_')
        ) {
            return;
        }

        $context->newElement(new ThematicBreak());
    }
}
