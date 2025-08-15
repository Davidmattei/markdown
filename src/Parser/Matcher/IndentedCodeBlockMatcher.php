<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Document\Block\Type\CodeBlock;
use Fabricity\Markdown\Document\Block\Type\Paragraph;
use Fabricity\Markdown\Parser\Context;

class IndentedCodeBlockMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line();

        if ($context->currentBlock instanceof CodeBlock && ($line->text->startsWith(' ') || $line->isNewLine())) {
            $context->currentBlock->append((string) $line->trimPrefix(4));
            $context->nextLine();

            return;
        }

        if ($line->text->startsWith("\t")) {
            $line = $line->trimPrefix(1, "\t")->prepend('    ');
        }


        if (!$line->text->startsWith('    ') || $context->currentBlock instanceof Paragraph) {
            return;
        }

        $context->newBlock(new CodeBlock((string) $line->trimPrefix(4)));
        $context->nextLine();
    }
}
