<?php

declare(strict_types=1);

namespace App\Filament\Traits;

trait HasTranslatedLabels
{
    public static function getNavigationLabel(): string
    {
        return __('FilamentResourceNavigationLabel'.static::getResourceName());
    }

    public static function getModelLabel(): string
    {
        return __('FilamentResourceModelLabel'.static::getResourceName());
    }

    public static function getPluralModelLabel(): string
    {
        return __('FilamentResourcePluralModelLabel'.static::getResourceName());
    }

    protected static function getResourceName(): string
    {
        return ucfirst(class_basename(static::getModel()));
    }
}
