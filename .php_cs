<?php

$finder = Symfony\Component\Finder\Finder::create()
    ->notPath('vendor')
    ->notPath('bootstrap')
    ->notPath('storage')
    ->in(__DIR__)
    ->name('*.php')
    ->notName('*.blade.php');

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'ordered_imports' => ['sortAlgorithm' => 'alpha'],
        'no_unused_imports' => true,
        'trailing_comma_in_multiline_array' => true,
        'no_multiline_whitespace_before_semicolons' => true,
        'ternary_to_null_coalescing' => true,
        'list_syntax' => ['syntax' => 'short'],
        'no_extra_blank_lines' => true,
        'not_operator_with_successor_space' => true,
        'phpdoc_summary' => true,
        'object_operator_without_whitespace' => true,
        'no_whitespace_in_blank_line' => true,
        'blank_line_before_statement' => true,
    ])
    ->setFinder($finder);
