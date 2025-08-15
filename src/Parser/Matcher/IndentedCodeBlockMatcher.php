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

        if ($context->currentElement instanceof CodeBlock && ($line->text->startsWith(' ') || $line->isNewLine())) {
            $context->currentElement->append((string) $line->trimPrefix(4));
            $context->nextLine();

            return;
        }

        if ($line->text->startsWith("\t")) {
            $line = $line->trimPrefix(1, "\t")->prepend('    ');
        }


        if (!$line->text->startsWith('    ') || $context->currentElement instanceof Paragraph) {
            return;
        }

        $context->newElement(new CodeBlock((string) $line->trimPrefix(4)));
        $context->nextLine();
    }
}
