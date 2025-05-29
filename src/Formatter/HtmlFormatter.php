<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Formatter;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Element\Heading;
use Fabricity\Markdown\Element\Paragraph;
use Fabricity\Markdown\Element\ThematicBreak;

class HtmlFormatter
{
    public function format(Document $document): string
    {
        $output = '';

        foreach ($document->getElements() as $element) {
            $output .= match(\get_class($element)) {
                Heading::class => \vsprintf(
                    format: '<h%d>%s</h%d>',
                    values: [$element->level, $element->title, $element->level]
                ),
                ThematicBreak::class => '<hr />',
                Paragraph::class => \sprintf('<p>%s</p>', $this->escapeContent($element->content)),
                default => '',
            };

            $output .= PHP_EOL;
        }

        return $output;
    }

    private function asciiPunctuationCharsEscaped(string $text): string
    {
        $replace = \preg_replace('/\\\\([!"#$%&\'()*+,\-.\/:;<=>?@\[\\\\\]^_`{|}~])/', '$1', $text);

        if (!is_string($replace)) {
            throw new \RuntimeException('Expected a non-empty string');
        }

        return $replace;
    }

    private function escapeContent(string $content): string
    {
        /** @var array<callable(string): string> $filters */
        $filters = [
            [$this, 'asciiPunctuationCharsEscaped'],
            [$this, 'htmlSpecialChars'],
            [$this, 'hardLineBreak'],
        ];

        $escaped = $content;
        foreach ($filters as $filter) {
            $escaped = $filter($escaped);
        }

        return $escaped;
    }

    private function hardLineBreak(string $input): string
    {
        $result = \preg_replace('/\\\\\n/', '<br />'.\PHP_EOL, $input);

        if (!is_string($result)) {
            throw new \RuntimeException('Expected a non-empty string');
        }

        return $result;
    }

    private function htmlSpecialChars(string $text): string
    {
        return \htmlspecialchars($text, ENT_COMPAT | ENT_HTML5);
    }
}
