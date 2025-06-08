<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

final class LogService
{
    public static function shouldLogMissingTranslationKeys(bool $logMissingTranslationKeys = false): void
    {
        if ($logMissingTranslationKeys) {
            Lang::handleMissingKeysUsing(function ($key, $replace, $locale, $fallback): void {
                Log::error("Missing translation key: {$key} in locale: {$locale}");
            });
        }
    }
}
