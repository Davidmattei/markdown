<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

use Michelf\Markdown;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class PhpMarkdownTest extends TestCase
{
    #[DataProviderExternal(SpecDataProvider::class, 'getData')]
    public function testParse(string $inputText, string $expectedHtml): void
    {
        $parser = new Markdown();
        $result = $parser->transform($inputText);

        $this->assertEquals($expectedHtml, $result);
    }
}
