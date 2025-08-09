<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Matcher;

/** @implements \IteratorAggregate<MatcherInterface> */
class Matchers implements \IteratorAggregate
{
    /** @var MatcherInterface[] */
    private array $matchers;

    public function __construct()
    {
        $this->matchers = [
            new BlockQuoteMatcher(),
            new HeadingMatcher(),
            new ThematicBreakMatcher(),
            new ParagraphMatcher(),
        ];
    }

    /** @return \Traversable<MatcherInterface> */
    public function getIterator(): \Traversable
    {
        foreach ($this->matchers as $matcher) {
            yield $matcher;
        }
    }
}
