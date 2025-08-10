<?php

declare(strict_types=1);

if (!$contents = \file_get_contents(__DIR__.'/commonmark-spec.json')) {
    throw new RuntimeException('Failed to read spec test data');
}

/** @var array<int, array{'example': int, 'section': string, 'markdown': string, 'html': string}> $specs */
$specs = \json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
if (JSON_ERROR_NONE !== \json_last_error()) {
    throw new RuntimeException('Invalid JSON: '.\json_last_error_msg());
}

function escapeForDoubleQuotes(string $str): string
{
    return \str_replace(
        ['\\', "\n", "\r", "\t", '"', '$'],
        ['\\\\', '\\n', '\\r', '\\t', '\\"', '\\$'],
        $str
    );
}

$data = [];

foreach ($specs as $spec) {
    $section = $spec['section'];
    $example = $spec['example'];
    $markdown = \escapeForDoubleQuotes($spec['markdown']);
    $html = \escapeForDoubleQuotes($spec['html']);

    $data[] = "'[$section] Example $example' => [\"$markdown\", \"$html\"]";

    $test = 1;
}

$dataContent = \implode(",\n", \array_map(static fn (string $v) => "            $v", $data));

$phpFile = <<<PHP
<?php

declare(strict_types=1);

namespace Fabricity\Markdown\Tests\Commonmark;

class CommonMarkSpecProvider
{
    /** @return array<mixed> */
    public static function getCommonMarkSpec(): array
    {
        return [
$dataContent
        ];
    }
}
PHP;

\file_put_contents(__DIR__.'/CommonMarkSpecProvider.php', $phpFile);
