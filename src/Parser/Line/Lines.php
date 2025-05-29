<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Parser\Line;

class Lines implements \IteratorAggregate
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = str_replace(["\r\n", "\r"], "\n", $text);
    }

    /**
     * @return \Traversable<Line>
     */
    public function getIterator(): \Traversable
    {
        $offset = 0;
        $length = strlen($this->text);

        while ($offset < $length) {
            $pos = strpos($this->text, "\n", $offset);

            if ($pos === false) {
                yield new Line(substr($this->text, $offset));
                return;
            }

            yield new Line(substr($this->text, $offset, $pos - $offset));
            $offset = $pos + 1;
        }

        if ($length > 0 && $this->text[$length - 1] === "\n") {
            yield new Line();
        }
    }
}
