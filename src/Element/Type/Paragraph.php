<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

class Paragraph implements TypeInterface
{
    public const string REGEX = '/^(?<content>.*(?:\r?\n(?!\r?\n).*)*)/';

    private function __construct(
        public readonly string $content,
    ) {
    }

    /** @param array{ 'content': string } $match */
    public static function fromMatch(array $match): self
    {
        return new self($match['content']);
    }

    public function toHtml(): string
    {
        return \sprintf('<p>%s</p>', $this->content);
    }
}
