<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

namespace BaseCodeOy\Standards;

use BaseCodeOy\Standards\Presets\PresetInterface;
use PhpCsFixer\Config;
use PhpCsFixer\ConfigInterface;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

final class ConfigurationFactory
{
    private static array $notName = [
        '_ide_helper_actions.php',
        '_ide_helper_models.php',
        '_ide_helper.php',
        '.phpstorm.meta.php',
        '*.blade.php',
    ];

    private static array $exclude = [
        'bootstrap/cache',
        'build',
        'node_modules',
        'storage',
    ];

    public static function createFromRules(array $rules): ConfigInterface
    {
        return (new Config())
            ->setFinder(self::finder())
            ->setRules($rules)
            ->setRiskyAllowed(true)
            ->setUsingCache(true);
    }

    public static function createFromPreset(PresetInterface $preset, array $overrideRules = []): ConfigInterface
    {
        if (\PHP_VERSION_ID < $preset->targetPhpVersion()) {
            throw new \RuntimeException(\sprintf(
                'Current PHP version "%s" is less than targeted PHP version "%s".',
                \PHP_VERSION_ID,
                $preset->targetPhpVersion(),
            ));
        }

        return (new Config($preset->name()))
            ->setFinder(self::finder())
            ->setRules(\array_merge($preset->rules(), $overrideRules))
            ->setRiskyAllowed(true)
            ->setUsingCache(true)
            ->setParallelConfig(ParallelConfigFactory::detect())
            ->registerCustomFixers(new \ErickSkrauch\PhpCsFixer\Fixers())
            ->registerCustomFixers(new \PhpCsFixerCustomFixers\Fixers())
            ->registerCustomFixers([
                new Fixers\AbstractNameFixer(),
                new Fixers\ExceptionNameFixer(),
                new Fixers\InterfaceNameFixer(),
                new Fixers\TraitNameFixer(),
                new Fixers\VariableCaseFixer(),
            ]);
    }

    public static function finder(): Finder
    {
        return Finder::create()
            ->notName(self::$notName)
            ->exclude(self::$exclude)
            ->ignoreDotFiles(true)
            ->ignoreVCS(true);
    }
}
