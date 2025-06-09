<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Parser\Line\Lines;
use Fabricity\Markdown\Parser\Matcher\Matchers;

readonly class Parser
{
    public function __construct(
        private Matchers $matcher = new Matchers(),
    ) {
    }

    public function match(Context $context): void
    {
        $currentIndex = $context->lines->getIndex();

        foreach ($this->matcher as $matcher) {
            $matcher->match($context);

            if ($context->lines->getIndex() !== $currentIndex) {
                return;
            }
        }

        throw new \RuntimeException(\sprintf('No match line %d "%s"', $currentIndex, $context->line()->text));
    }

    public function parse(string $text): Document
    {
        $document = new Document();
        $lines = Lines::fromText($text);
        $context = new Context($lines, $document);

        while ($lines->hasLines()) {
            $this->match($context);
        }

        return $document;
    }
}
