<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Element\Type\Paragraph;

class MarkdownBuilder
{
    /** @var ElementInterface[] */
    private array $elements = [];

    /**
     * @param array{ 'max_line_length'?: int } $options
     */
    public function __construct(private readonly array $options)
    {
    }

    public function addElement(ElementInterface $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function addParagraph(string $text): self
    {
        return $this->addElement(
            new Paragraph(
                (string) (new Text($text))
                ->sanitize()
                ->maxLineLength($this->options['max_line_length'] ?? null)
            )
        );
    }

    public function build(): string
    {
        $flatElements = \array_map(fn (ElementInterface $element) => $element->toMarkdown(), $this->elements);

        return \implode(\PHP_EOL, $flatElements);
    }

    /**
     * @param array{ 'max_line_length'?: int } $options
     */
    public static function create(array $options): self
    {
        return new self($options);
    }
}
