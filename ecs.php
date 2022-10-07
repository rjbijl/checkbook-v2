<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\ControlStructure\YodaStyleFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PARALLEL, true);

    // Path config
    $containerConfigurator->paths([
        __DIR__ . '/ecs.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
        //        __DIR__ . '/rector.php',
    ]);

    $containerConfigurator->skip([
        // Do not force space after `not` operator
        NotOperatorWithSuccessorSpaceFixer::class,

        // Allow assignment in conditions
        AssignmentInConditionSniff::class,

        // Allow yoda conditions
        YodaStyleFixer::class,
    ]);

    // Full sets
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::COMMENTS);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::DOCBLOCK);
    $containerConfigurator->import(SetList::NAMESPACES);
    $containerConfigurator->import(SetList::PHPUNIT);
    $containerConfigurator->import(SetList::SPACES);
    $containerConfigurator->import(SetList::DOCTRINE_ANNOTATIONS);

    // Standalone rules
    $services = $containerConfigurator->services();

    // Override spacing settings
    $services->set(\PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer::class)
        ->call('configure', [[
            'elements' => [
                'const' => 'none',
                'property' => 'one',
                'method' => 'one',
                'trait_import' => 'none',
            ],
        ]]);

    // Use imports instead of FQCN
    $services->set(\PhpCsFixer\Fixer\Import\FullyQualifiedStrictTypesFixer::class);
    $services->set(\PhpCsFixer\Fixer\Import\GlobalNamespaceImportFixer::class)
        ->call('configure', [[
            'import_classes' => false,
        ]]);

    // Remove @author tags
    $services->set(\PhpCsFixer\Fixer\Phpdoc\GeneralPhpdocAnnotationRemoveFixer::class)
        ->call('configure', [[
            'annotations' => ['category'],
        ]]);

    // These come from the Symfony set. The rest in that set is either not wanted or covered above.
    $services->set(\PhpCsFixer\Fixer\LanguageConstruct\IsNullFixer::class);
    $services->set(\PhpCsFixer\Fixer\ControlStructure\IncludeFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\ObjectOperatorWithoutWhitespaceFixer::class);
    $services->set(\PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer::class)
        ->call('configure', [[
            'tokens' => [
                'curly_brace_block',
                'extra',
                'parenthesis_brace_block',
                'square_brace_block',
                'throw',
                'use',
            ],
        ]]);

    $services->set(\PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer::class);

    $services->set(\PhpCsFixer\Fixer\Phpdoc\NoBlankLinesAfterPhpdocFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoPackageFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocScalarFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocToCommentFixer::class);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocTypesOrderFixer::class)
        ->call('configure', [[
            'null_adjustment' => 'always_last',
            'sort_algorithm' => 'none',
        ]]);
    $services->set(\PhpCsFixer\Fixer\Phpdoc\PhpdocNoAliasTagFixer::class);
    $services->set(\PhpCsFixer\Fixer\Operator\StandardizeNotEqualsFixer::class);
};
