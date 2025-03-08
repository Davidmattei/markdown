<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Fabricity\Markdown\Markdown;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class PhpMarkdownTest extends TestCase
{
    #[DataProviderExternal(SpecDataProvider::class, 'getData')]
    public function testParse(string $inputText, string $expectedHtml): void
    {
        $result = new Markdown()->parse($inputText);

        $this->assertEquals($expectedHtml, $result);
    }
}
