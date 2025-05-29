<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Paragraph;
use Fabricity\Markdown\Parser\Context;

class ParagraphMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        if ($context->line->isNewLine()) {
            $context->newLine();

            return;
        }

        if ($context->element instanceof Paragraph) {
            $context->updateElement();
        } else {
            $context->newElement(new Paragraph($context->line->text));
        }
    }
}
