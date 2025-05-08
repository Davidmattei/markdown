<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Element\Element;
use Fabricity\Markdown\Element\ElementCollection;
use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Markdown\Heading;
use Fabricity\Markdown\Markdown\Paragraph;
use Fabricity\Markdown\Markdown\ThematicBreak;

class Parser
{
    /** @var array<int, class-string<ElementInterface>> */
    public array $elements;

    private int $cursor = 0;

    public function __construct()
    {
        $this->elements = [
            Heading::class,
            Paragraph::class,
//            ThematicBreak::class
        ];
    }

    public function parse(Input $input): string
    {
        $types = [];

        while ($input->hasText()) {
            if ($input->isNewLine()) {
                continue;
            }

            if (null === $element = $this->matchElements($input)) {
                throw new \RuntimeException('Could not parse input');
            }

            $types[] = $element;
        }

        $htmlTypes = \array_map(static fn (ElementInterface $type): string => $type->toHtml(), $types);

        return \implode(\PHP_EOL, $htmlTypes).\PHP_EOL;
    }


    private function matchElements(Input $input): ?ElementInterface
    {
        foreach ($this->elements as $element) {
            if (null === $type = $element::match($input)) {
                continue;
            }

            return $type;
        }

        return null;
    }
}
