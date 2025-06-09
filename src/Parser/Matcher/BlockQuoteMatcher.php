<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\BlockQuote;
use Fabricity\Markdown\Parser\Context;

class BlockQuoteMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {


        // @todo implement

        //        $line = $context->line()->trimPrefix(3);
        //
        //        if (!$line->startsWith('>')) {
        //            return;
        //        }
        //
        //        $remaining = $line->trimPrefix(1, '>')->trimPrefix(1);
        //
        //        $context
        //            ->newElement(new BlockQuote())
        //            ->remaining($remaining)
        //            ->advance()
        //        ;
    }
}
