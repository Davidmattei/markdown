<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Formatter\HtmlFormatter;
use Fabricity\Markdown\Parser\Parser;

class Markdown
{
    public function toHtml(string $text): string
    {
        $document = new Parser()->parse($text);

        return new HtmlFormatter()->format($document);
    }
}
