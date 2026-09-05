<?php

namespace App\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Throwable;

class TranslationHelper
{
    public static function TranslateText($text)
    {
        $locale = app()->getLocale();

        if ($locale === "fr" || empty($text)) {
            return $text;
        }

        $cacheKey = 'translation_' . md5($text . '_' . $locale);

        return cache()->remember($cacheKey, now()->addDays(7), function () use ($text, $locale) {
            try {
                $tr = new GoogleTranslate($locale);

                // Forcer un client Guzzle avec un timeout strict de 2 secondes
                $httpClient = new Client([
                    'timeout' => 2.0,
                    'connect_timeout' => 1.5,
                    'verify' => false,
                ]);

                $tr->setHttpClient($httpClient);

                return $tr->translate($text);
            } catch (Throwable $e) {
                // En cas de dépassement de délai ou d'erreur réseau, consigner dans les logs et retourner le texte français
                Log::warning("Erreur traduction ('$text') : " . $e->getMessage());
                return $text;
            }
        });
    }

    public static function TranslateText0($text)
    {
        $translated = static::TranslateText($text);

        if (empty($translated)) {
            return $translated;
        }

        return mb_strtoupper(mb_substr($translated, 0, 1)) . mb_substr($translated, 1);
    }
}