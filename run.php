<?php

declare(strict_types=1);

require __DIR__.'/vendor/autoload.php';

use Fabricity\Markdown\Token\Tokenizer;

$input = <<<MARKDOWN

test

MARKDOWN;

echo $input;

$tokenizer = new Tokenizer($input);
$tokenizer->tokenize();

foreach ($tokenizer->getTokens() as $token) {
    echo sprintf('%s : %s '.\PHP_EOL, $token->type->name, str_replace(\PHP_EOL, '\\N', $token->value));
}
