<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Standards\Presets;

final class Ordered implements PresetInterface
{
    #[\Override()]
    public function name(): string
    {
        return 'Ordered';
    }

    #[\Override()]
    public function rules(): array
    {
        return [
            'ordered_attributes' => [
                'order' => [],
                'sort_algorithm' => 'alpha',
            ],
            'ordered_class_elements' => [
                'order' => [
                    'use_trait',
                    'case',
                    'constant_public',
                    'constant_protected',
                    'constant_private',
                    'property_public_static',
                    'property_public',
                    'property_public_readonly',
                    'property_protected_static',
                    'property_protected',
                    'property_protected_readonly',
                    'property_private_static',
                    'property_private',
                    'property_private_readonly',
                    'construct',
                    'destruct',
                    'magic',
                    'phpunit',
                    'method_public_static',
                    'method_public_abstract_static',
                    'method_public',
                    'method_public_abstract',
                    'method_protected_static',
                    'method_protected_abstract_static',
                    'method_protected',
                    'method_protected_abstract',
                    'method_private_static',
                    'method_private_abstract_static',
                    'method_private',
                    'method_private_abstract',
                ],
                'sort_algorithm' => 'none',
            ],
            'ordered_imports' => [
                'imports_order' => [
                    'class',
                    'const',
                    'function',
                ],
                'sort_algorithm' => 'alpha',
            ],
            'ordered_interfaces' => [
                'direction' => 'ascend',
                'order' => 'alpha',
            ],
            'ordered_traits' => false,
        ];
    }

    #[\Override()]
    public function targetPhpVersion(): int
    {
        return 80_200;
    }
}
