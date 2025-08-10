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

        if ($context->currentElement instanceof CodeBlock && ($line->startsWith(' ') || $line->isNewLine())) {
            $context->currentElement->append($line->trimPrefix(4, ' ')->text);
            $context->nextLine();

            return;
        }

        if ($line->startsWith("\t")) {
            $line = $line->trimPrefix(1, "\t")->prepend('    ');
        }


        if (!$line->startsWith('    ') || $context->currentElement instanceof Paragraph) {
            return;
        }

        $context->newElement(new CodeBlock($line->trimPrefix(4, ' ')->text));
        $context->nextLine();
    }
}
