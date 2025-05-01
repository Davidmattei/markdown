<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

class Markdown
{
    private Parser $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function parse(string $text): string
    {
        return $this->parser->parse($text);
    }
}
