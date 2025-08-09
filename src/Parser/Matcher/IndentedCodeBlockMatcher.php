<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\CodeBlock;
use Fabricity\Markdown\Parser\Context;

class IndentedCodeBlockMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        if (!$context->line()->startsWith('    ')) {
            return;
        }

        $content = $context->line()->trimPrefix(4, ' ')->text;

        if ($context->currentElement instanceof CodeBlock) {
            $context->currentElement->content .= "\n".$content;
        } else {
            $context->newElement(new CodeBlock($content));
        }

        $context->nextLine();
    }
}
