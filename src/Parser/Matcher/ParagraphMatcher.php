<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\Paragraph;
use Fabricity\Markdown\Parser\Context;

class ParagraphMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line();

        if ($line->isNewLine()) {
            $context->finishElement();

            return;
        }

        if ($context->currentElement instanceof Paragraph) {
            $context->currentElement->content .= "\n".$line->trimStart()->text;
        } else {
            $context->newElement(new Paragraph($line->text));
        }

        $context->nextLine();
    }
}
