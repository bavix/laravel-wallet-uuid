<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\PropertyFetch\ExplicitMethodCallOverMagicGetSetRector;
use Rector\Config\RectorConfig;
use Rector\Laravel\Set\LaravelSetList;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->parallel();
    $config->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $config->skip([ExplicitMethodCallOverMagicGetSetRector::class]);

    // Define what rule sets will be applied
    $config->import(PHPUnitSetList::PHPUNIT_91);
    $config->import(LaravelSetList::LARAVEL_80);
    $config->import(SetList::CODE_QUALITY);
    $config->import(SetList::DEAD_CODE);
    $config->import(SetList::PHP_80);

    // get services (needed for register a single rule)
    $services = $config->services();

    // register a single rule
    $services->set(TypedPropertyRector::class);
};
