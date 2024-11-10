<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Standards\Presets;

final class PHPUnit implements PresetInterface
{
    #[\Override()]
    public function name(): string
    {
        return 'PHPUnit';
    }

    #[\Override()]
    public function rules(): array
    {
        return [
            'php_unit_data_provider_name' => true,
            'php_unit_data_provider_return_type' => true,
            'php_unit_data_provider_static' => true,
            'php_unit_dedicate_assert' => [
                'target' => 'newest',
            ],
            'php_unit_dedicate_assert_internal_type' => [
                'target' => 'newest',
            ],
            'php_unit_expectation' => [
                'target' => 'newest',
            ],
            'php_unit_fqcn_annotation' => true,
            'php_unit_internal_class' => [
                'types' => [
                    'abstract',
                    'final',
                    'normal',
                ],
            ],
            'php_unit_method_casing' => [
                'case' => 'snake_case',
            ],
            'php_unit_mock' => [
                'target' => 'newest',
            ],
            'php_unit_mock_short_will_return' => true,
            'php_unit_namespaced' => [
                'target' => 'newest',
            ],
            'php_unit_no_expectation_annotation' => [
                'target' => 'newest',
                'use_class_const' => true,
            ],
            'php_unit_set_up_tear_down_visibility' => true,
            'php_unit_size_class' => false,
            'php_unit_strict' => false,
            'php_unit_test_annotation' => [
                'style' => 'prefix',
            ],
            'php_unit_test_case_static_method_calls' => [
                'call_type' => 'self',
                'methods' => [],
            ],
            // This messes with using the `PHPUnit\Framework\Attributes\CoversNothing` attribute
            'php_unit_test_class_requires_covers' => false,
            \PhpCsFixerCustomFixers\Fixer\PhpUnitAssertArgumentsOrderFixer::name() => true,
            \PhpCsFixerCustomFixers\Fixer\PhpUnitDedicatedAssertFixer::name() => true,
            \PhpCsFixerCustomFixers\Fixer\PhpUnitNoUselessReturnFixer::name() => true,
        ];
    }

    #[\Override()]
    public function targetPhpVersion(): int
    {
        return 80_200;
    }
}
