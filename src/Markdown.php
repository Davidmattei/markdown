<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Parser\Input;
use Fabricity\Markdown\Parser\Parser;

class Markdown
{
    private Parser $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function parse(string $text): string
    {
        return $this->parser->parse(new Input($text));
    }
}
