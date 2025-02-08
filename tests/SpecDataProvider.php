<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests;

class SpecDataProvider
{
    public static function getData(): array
    {
        if (!$contents = file_get_contents(__DIR__ . '/spec/commonmark-spec.json')) {
            throw new RuntimeException('Failed to read spec test data');
        }

        $json = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \RuntimeException('Invalid JSON: ' . json_last_error_msg());
        }

        return array_reduce($json, function ($carry, $item) {
            $name = sprintf('Example %d [%s]', $item['example'], $item['section']);
            $carry[$name] = [$item['markdown'], $item['html']];
            return $carry;
        }, []);
    }
}
