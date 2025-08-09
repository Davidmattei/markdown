<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Formatter;

use Fabricity\Markdown\Element\Document;
use Fabricity\Markdown\Element\Elements;
use Fabricity\Markdown\Element\Type\BlockQuote;
use Fabricity\Markdown\Element\Type\CodeBlock;
use Fabricity\Markdown\Element\Type\Heading;
use Fabricity\Markdown\Element\Type\Paragraph;
use Fabricity\Markdown\Element\Type\ThematicBreak;

class HtmlFormatter
{
    public function format(Document $document): string
    {
        return $this->formatElements($document->getElements());
    }

    private function escape(string $content): string
    {
        /** @var array<callable(string): string> $filters */
        $filters = [
            [$this, 'escapeAsciiPunctuationCharsEscaped'],
            [$this, 'escapeHtmlSpecialChars'],
            [$this, 'escapeHardLineBreak'],
        ];

        $escaped = $content;
        foreach ($filters as $filter) {
            $escaped = $filter($escaped);
        }

        return $escaped;
    }

    private function escapeAsciiPunctuationCharsEscaped(string $text): string
    {
        $replace = \preg_replace('/\\\\([!"#$%&\'()*+,\-.\/:;<=>?@\[\\\\\]^_`{|}~])/', '$1', $text);

        if (!\is_string($replace)) {
            throw new \RuntimeException('Expected a non-empty string');
        }

        return $replace;
    }

    private function escapeHardLineBreak(string $input): string
    {
        $result = \preg_replace('/\\\\\n/', '<br />'.\PHP_EOL, $input);

        if (!\is_string($result)) {
            throw new \RuntimeException('Expected a non-empty string');
        }

        return $result;
    }

    private function escapeHtmlSpecialChars(string $text): string
    {
        return \htmlspecialchars($text, ENT_COMPAT | ENT_HTML5);
    }

    private function formatBlockQuote(BlockQuote $blockQuote): string
    {
        $formatElements = $this->formatElements($blockQuote->getElements());

        return "<blockquote>\n$formatElements</blockquote>";
    }

    private function formatCodeBlock(CodeBlock $element): string
    {
        return "<pre><code>{$element->content}\n</code></pre>";
    }

    private function formatElements(Elements $elements): string
    {
        $output = '';

        foreach ($elements as $element) {
            $output .= match (\get_class($element)) {
                Heading::class => $this->formatHeading($element),
                ThematicBreak::class => $this->formatThematicBreak(),
                Paragraph::class => $this->formatParagraph($element),
                BlockQuote::class => $this->formatBlockQuote($element),
                CodeBlock::class => $this->formatCodeBlock($element),
                default => '',
            };

            $output .= PHP_EOL;
        }

        return $output;
    }

    private function formatHeading(Heading $heading): string
    {
        return "<h$heading->level>$heading->title</h$heading->level>";
    }

    private function formatParagraph(Paragraph $paragraph): string
    {
        $escapedContent = $this->escape($paragraph->content);

        return "<p>$escapedContent</p>";
    }

    private function formatThematicBreak(): string
    {
        return '<hr />';
    }
}
