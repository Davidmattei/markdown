<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Element\Type;

use Fabricity\Markdown\Element\AbstractElement;

class CodeBlock extends AbstractElement
{
    /** @var string[] */
    private array $lines = [];

    public function __construct(
        string $content,
    ) {
        $this->append($content);
    }

    public function append(string $content): void
    {
        $this->lines[] = $content;
    }

    public function getContent(): string
    {
        return \implode("\n", $this->lines);
    }

    public function isSingleLine(): bool
    {
        return 1 === \count($this->lines);
    }

    /** @return array{'type': 'Code block', 'content': string} */
    public function jsonSerialize(): array
    {
        return [
            'type' => 'Code block',
            'content' => $this->getContent(),
        ];
    }
}
