<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Markdown;

use Fabricity\Markdown\Element\ElementInterface;
use Fabricity\Markdown\Parser\Input;

class Paragraph implements ElementInterface
{
    public const string REGEX = '/^(?<content>(?:[^\r\n].*(?:\r?\n(?!\r?\n)[^\r\n].*)*)?)/';

    private function __construct(
        public readonly Text $content,
    ) {
    }

    public static function match(Input $input): ?self
    {
        $matches = [];
        if (!$input->match(self::REGEX, $matches)) {
            return null;
        }

        $input->offsetText($matches['content']);

        return new self(new Text($matches['content']));
    }

    public function toHtml(): string
    {
        return \sprintf('<p>%s</p>', $this->content->toHtml());
    }
}
