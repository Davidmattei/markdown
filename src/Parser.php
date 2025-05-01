<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Element\Element;
use Fabricity\Markdown\Element\ElementCollection;
use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Element\Type\Paragraph;
use Fabricity\Markdown\Element\Type\TypeInterface;

class Parser
{
    public ElementCollection $elements;

    private int $cursor = 0;

    public function __construct()
    {
        $this->elements = new ElementCollection()
            ->add(new Element(Heading::class, Heading::REGEX))
            ->add(new Element(Paragraph::class, Paragraph::REGEX))
        ;
    }

    public function parse(string $text): string
    {
        $length = \strlen($text);
        $types = [];

        while ($this->cursor < $length) {
            $input = \substr($text, $this->cursor);

            if (null !== $type = $this->match($input)) {
                $types[] = $type;
            }
        }

        $htmlTypes = \array_map(static fn (TypeInterface $type): string => $type->toHtml(), $types);

        return \implode(\PHP_EOL, $htmlTypes);
    }

    private function match(string $input): ?TypeInterface
    {
        foreach ($this->elements as $element) {
            if (\preg_match('/^\n/', $input, $match)) {
                $this->cursor += \strlen($match[0]);

                return null;
            }

            if (\preg_match($element->regex, $input, $match)) {
                $this->cursor += \strlen($match[0]);

                return $element->typeClass::fromMatch($match);
            }
        }

        throw new \RuntimeException('could not parse!');
    }
}
