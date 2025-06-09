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
            $context->clearElement()->advance();

            return;
        }

        if ($context->element instanceof Paragraph) {
            $context->element->content .= "\n".$line->text;
        } else {
            $context->newElement(new Paragraph($line->text));
        }

        $context->advance();
    }
}
