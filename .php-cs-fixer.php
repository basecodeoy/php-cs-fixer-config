<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * Unauthorized copying, distribution, or use of this file in any manner
 * is strictly prohibited. This material is proprietary and confidential.
 */

use BaseCodeOy\Standards\ConfigurationFactory;
use BaseCodeOy\Standards\Presets\Standard;

$config = ConfigurationFactory::createFromPreset(new Standard());

/** @var PhpCsFixer\Finder $finder */
$finder = $config->getFinder();
$finder->in(__DIR__);

return $config;
