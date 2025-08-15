<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Formatter;

use Fabricity\Markdown\Document\Block\Blocks;
use Fabricity\Markdown\Document\Block\Inline;
use Fabricity\Markdown\Document\Block\Type\BlockQuote;
use Fabricity\Markdown\Document\Block\Type\CodeBlock;
use Fabricity\Markdown\Document\Block\Type\Heading;
use Fabricity\Markdown\Document\Block\Type\Paragraph;
use Fabricity\Markdown\Document\Block\Type\ThematicBreak;
use Fabricity\Markdown\Document\Document;

class HtmlFormatter
{
    public function format(Document $document): string
    {
        return $this->formatBlocks($document->getBlocks());
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
        $formatBlocks = $this->formatBlocks($blockQuote->getBlocks());

        return "<blockquote>\n$formatBlocks</blockquote>";
    }

    private function formatBlocks(Blocks $blocks): string
    {
        $output = '';

        foreach ($blocks as $block) {
            $output .= match (\get_class($block)) {
                Heading::class => $this->formatHeading($block),
                ThematicBreak::class => $this->formatThematicBreak(),
                Paragraph::class => $this->formatParagraph($block),
                BlockQuote::class => $this->formatBlockQuote($block),
                CodeBlock::class => $this->formatCodeBlock($block),
                default => '',
            };

            $output .= PHP_EOL;
        }

        return $output;
    }

    private function formatCodeBlock(CodeBlock $codeBlock): string
    {
        $escapedContent = $this->escape($codeBlock->getContent());

        if ($codeBlock->isSingleLine()) {
            return "<pre><code>$escapedContent\n</code></pre>";
        }

        return "<pre><code>$escapedContent</code></pre>";
    }

    private function formatHeading(Heading $heading): string
    {
        $title = $this->formatInline($heading->title);

        return "<h$heading->level>$title</h$heading->level>";
    }

    private function formatInline(Inline $title): string
    {
        return (string) $title;
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
