<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser;

use Fabricity\Markdown\Parser\Matcher\HeadingMatcher;
use Fabricity\Markdown\Parser\Matcher\MatcherInterface;
use Fabricity\Markdown\Parser\Matcher\ParagraphMatcher;
use Fabricity\Markdown\Parser\Matcher\ThematicBreakMatcher;

/** @implements \IteratorAggregate<MatcherInterface> */
class Matchers implements \IteratorAggregate
{
    /** @var MatcherInterface[] */
    private array $matchers;

    public function __construct()
    {
        $this->matchers = [
            new HeadingMatcher(),
            new ThematicBreakMatcher(),
            new ParagraphMatcher(),
        ];
    }

    /**
     * @return \Traversable<MatcherInterface>
     */
    public function getIterator(): \Traversable
    {
        foreach ($this->matchers as $matcher) {
            yield $matcher;
        }
    }
}
