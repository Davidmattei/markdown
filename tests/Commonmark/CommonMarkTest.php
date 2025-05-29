<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Commonmark;

use Fabricity\Markdown\Markdown;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

class CommonMarkTest extends TestCase
{
    #[DataProvider('getData')]
    public function testParse(string $inputText, string $expectedHtml): void
    {
        $result = new Markdown()->toHtml($inputText);

        $this->assertEquals($expectedHtml, $result);
    }

    /** @return array<mixed> */
    public static function getData(): array
    {
        if (!$contents = \file_get_contents(__DIR__.'/commonmark-spec.json')) {
            throw new \RuntimeException('Failed to read spec test data');
        }

        /** @var array<int, array{'example': string, 'section': string, 'markdown': string, 'html': string}> $json */
        $json = \json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        if (JSON_ERROR_NONE !== \json_last_error()) {
            throw new \RuntimeException('Invalid JSON: '.\json_last_error_msg());
        }

        /** @var array<mixed> $data */
        $data = \array_reduce($json, static function (array $carry, array $item) {
            $name = \sprintf('Example %d [%s]', $item['example'], $item['section']);
            $carry[$name] = [$item['markdown'], $item['html']];

            return $carry;
        }, []);

        return $data;
    }
}
