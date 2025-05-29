<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Formatter\HtmlFormatter;
use Fabricity\Markdown\Parser\Parser;

class Markdown
{
    private Parser $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function toHtml(string $text): string
    {
        $document = $this->parser->parse($text);

        return new HtmlFormatter()->format($document);
    }
}
