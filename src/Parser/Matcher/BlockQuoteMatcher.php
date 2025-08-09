<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\BlockQuote;
use Fabricity\Markdown\Parser\Context;

class BlockQuoteMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line()->trimPrefix(3);

        if (!$line->startsWith('>')) {
            return;
        }

        if (!$context->parent instanceof BlockQuote) {
            $context->newElement(new BlockQuote());
        }

        $remaining = $line->trimPrefix(1, '>')->trimPrefix();
        $context->remainingLine($remaining);
    }
}
