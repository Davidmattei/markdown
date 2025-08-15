<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Parser\Context;
use Fabricity\Markdown\Parser\Text;

class HeadingMatcher implements MatcherInterface
{
    public function match(Context $context): void
    {
        $matches = [];

        $test = (string) $context->line()->text;

        if (!\preg_match('/^ {0,3}(?<level>#{1,6})(?<title>(\s+.*))?$/', (string) $context->line()->text, $matches)) {
            return;
        }

        $matchTitle = $matches['title'] ?? '';

        if (\preg_match('/^(?<title>.+)?[ |\t]#+([ \t]+)?$/', $matchTitle, $matchEnd)) {
            $title = new Text($matchEnd['title'] ?? '');
        } else {
            $title = new Text($matchTitle);
        }

        $title = $title->replace('\#', '#')->trim();

        $context
            ->newElement(new Heading(\strlen($matches['level']), (string) $title))
            ->nextLine();
    }
}
