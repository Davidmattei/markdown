<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Token;

readonly class Token
{
    public function __construct(public TokenType $type, public string $value)
    {
    }
}
