<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Document\Block\Type\Paragraph;
use Fabricity\Markdown\Parser\Context;

class ParagraphMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $line = $context->line();

        if ($line->isNewLine()) {
            $context->finishBlock();

            return;
        }

        if ($context->currentBlock instanceof Paragraph) {
            $context->currentBlock->content .= "\n".$line->trimStart()->text;
        } else {
            $context->newBlock(new Paragraph((string) $line));
        }

        $context->nextLine();
    }
}
