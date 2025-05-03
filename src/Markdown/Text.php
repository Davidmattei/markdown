<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Markdown;

readonly class Text
{
    public function __construct(
        private string $text,
    ) {
    }

    public function toHtml(): string
    {
        $text = $this->text;
        $text = $this->asciiPunctuationCharsEscaped($text);
        $text = $this->htmlSpecialChars($text);
        $text = $this->hardLineBreak($text);

       return $text;
    }

    private function asciiPunctuationCharsEscaped(string $text): string
    {
        return preg_replace('/\\\\([!"#$%&\'()*+,\-.\/:;<=>?@\[\\\\\]^_`{|}~])/', '$1', $text);
    }

    private function htmlSpecialChars(string $text): string
    {
        return htmlspecialchars($text, ENT_COMPAT | ENT_HTML5);
    }

    private function hardLineBreak(string $input): string
    {
        return preg_replace('/\\\\\n/', '<br />'.\PHP_EOL, $input);
    }
}
