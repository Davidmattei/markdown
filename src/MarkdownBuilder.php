<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Element\Type\Paragraph;

class MarkdownBuilder
{
    /** @var ElementInterface[] */
    private array $elements = [];

    /**
     * @param array{
     *     'max_line_length'?: int,
     *     'header_alternate_syntax'?: bool
     * } $options
     */
    public function __construct(private readonly array $options)
    {
    }

    public function addElement(ElementInterface $element): self
    {
        $this->elements[] = $element;

        return $this;
    }

    public function build(): string
    {
        $flatElements = \array_map(fn (ElementInterface $element) => $element->toMarkdown(), $this->elements);

        return \implode(\PHP_EOL, $flatElements);
    }

    public function h1(string $text): self
    {
        return $this->addHeading(1, $text);
    }

    public function h2(string $text): self
    {
        return $this->addHeading(2, $text);
    }

    public function h3(string $text): self
    {
        return $this->addHeading(3, $text);
    }

    public function h4(string $text): self
    {
        return $this->addHeading(4, $text);
    }

    public function h5(string $text): self
    {
        return $this->addHeading(5, $text);
    }

    public function h6(string $text): self
    {
        return $this->addHeading(6, $text);
    }

    public function p(string $text): self
    {
        return $this->addElement(
            new Paragraph(
                (string) (new Text($text))
                    ->sanitize()
                    ->maxLineLength($this->options['max_line_length'] ?? null)
            )
        );
    }

    private function addHeading(int $size, string $text): self
    {
        return $this->addElement(new Heading(
            size: $size,
            text: $text,
            alternateSyntax: $this->options['header_alternate_syntax'] ?? false
        ));
    }
}
