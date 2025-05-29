<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Parser\Line\Lines;

class Parser
{
    private Matchers $matchers;

    public function __construct()
    {
        $this->matchers = new Matchers();
    }

    public function parse(string $text): Document
    {
        $document = new Document();

        $element = null;
        $lines = new Lines($text);

        foreach ($lines as $line) {
            $context = new Context($line, $document, $element);

            foreach ($this->matchers as $matcher) {
                $matcher->match($context);

                if ($context->isParsed()) {
                    $element = $context->element;
                    break;
                }
            }

            if (!$context->isParsed()) {
                throw new \RuntimeException('Could not parse line');
            }
        }

        return $document;
    }
}
