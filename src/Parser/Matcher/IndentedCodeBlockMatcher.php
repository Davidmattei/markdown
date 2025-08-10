<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\CodeBlock;
use Fabricity\Markdown\Element\Type\Paragraph;
use Fabricity\Markdown\Parser\Context;

class IndentedCodeBlockMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line();
        $content = $line->trimPrefix(4, ' ')->text;

        if ($context->currentElement instanceof CodeBlock && ($line->startsWith(' ') || $line->isNewLine())) {
            $context->currentElement->append($content);
            $context->nextLine();

            return;
        }

        if (!$line->startsWith('    ') || $context->currentElement instanceof Paragraph) {
            return;
        }

        $context->newElement(new CodeBlock($content));
        $context->nextLine();
    }
}
