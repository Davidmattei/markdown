<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
;

return (new PhpCsFixer\Config())
    ->setCacheFile(__DIR__.'/.cache/.php-cs-fixer')
    ->setParallelConfig(PhpCsFixer\Runner\Parallel\ParallelConfigFactory::detect())
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'native_function_invocation' => ['include' => ['@all']],
        'ordered_class_elements' => ['sort_algorithm' => 'alpha']
    ])
    ->setRiskyAllowed(true)
    ->setFinder($finder)
;
