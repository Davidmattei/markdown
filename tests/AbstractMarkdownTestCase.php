<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Fabricity\Markdown\Markdown;
use PHPUnit\Framework\TestCase;

class AbstractMarkdownTestCase extends TestCase
{
    protected Markdown $markdown;

    protected function setUp(): void
    {
        $this->markdown = new Markdown();
    }

    protected function assertMarkdown(string $markdown, string $html): void
    {
        $this->assertSame($html, $this->markdown->parse($markdown));
    }
}
