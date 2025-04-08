<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/app',
        __DIR__ . '/config',
        __DIR__ . '/database',
        __DIR__ . '/routes',
        __DIR__ . '/tests',
    ])
    ->exclude([
        'storage',
        'vendor',
        'bootstrap/cache',
        'node_modules',
        'public', // Evitar mexer em assets
    ]);

return (new PhpCsFixer\Config())
    ->setRules([
        '@PSR12'                      => true,
        'array_syntax'                => ['syntax' => 'short'], // Array com []
        'binary_operator_spaces'      => ['default' => 'align_single_space_minimal'], // Alinha =>
        'ordered_imports'             => ['sort_algorithm' => 'alpha'], // Organiza imports
        'no_unused_imports'           => true, // Remove imports não usados
        'single_quote'                => true, // Força aspas simples
        'blank_line_before_statement' => [ // Espaçamento pra legibilidade
            'statements' => [
                'return',
                'throw',
                'if',
                'foreach',
                'while',
                'switch',
                'try',
            ],
        ],
        'phpdoc_align'               => ['align' => 'left'], // Comentários PHPDoc alinhados
        'phpdoc_separation'          => false, // Não força linhas extras no PHPDoc
        'phpdoc_trim'                => true, // Remove espaços desnecessários no PHPDoc
        'no_superfluous_phpdoc_tags' => true, // Remove tags PHPDoc desnecessárias
    ])
    ->setIndent('  ')
    ->setFinder($finder)
    ->setRiskyAllowed(true)
    ->setUsingCache(true);
