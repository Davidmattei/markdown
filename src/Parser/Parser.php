<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Document\Document;
use Fabricity\Markdown\Parser\Line\Lines;
use Fabricity\Markdown\Parser\Matcher\Matchers;

readonly class Parser
{
    public function __construct(
        private Matchers $matcher = new Matchers(),
    ) {
    }

    public function parse(string $text): Document
    {
        $document = new Document();
        $lines = Lines::fromText($text);
        $context = new Context($lines, $document);

        while ($lines->cursor->valid()) {
            $this->match($context);
        }

        return $document;
    }

    private function match(Context $context): void
    {
        $cursor = $context->lines->cursor;
        $currentPosition = $cursor->value();

        foreach ($this->matcher as $matcher) {
            $matcher->match($context);
            $matchPosition = $cursor->value();

            if ($currentPosition !== $matchPosition) {
                return;
            }
        }

        throw new \RuntimeException(\sprintf('No match line %d "%s"', $cursor->getLine(), $context->line()->text));
    }
}
