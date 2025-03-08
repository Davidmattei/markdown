<?php

declare(strict_types=1);

namespace Fabricity\Markdown;

use Fabricity\Markdown\Token\Tokenizer;

class Markdown
{
    public function parse(string $text): string
    {
        $tokens = new Tokenizer($text)->getTokens();


        return $text;
    }
}
