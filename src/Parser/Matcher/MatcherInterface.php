<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

use Fabricity\Markdown\Parser\Context;

interface MatcherInterface
{
    public function match(Context $context): void;
}
