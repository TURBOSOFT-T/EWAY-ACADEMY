<?php

namespace App\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
public static function TranslateText0($text)
{
    $locale = app()->getLocale();

    if ($locale == "fr" || empty($text)) {
        return $text;
    }

    $cacheKey = 'translation_' . md5($text . '_' . $locale);

    $translated = cache()->remember($cacheKey, now()->addDays(7), function () use ($text, $locale) {
        $tr = new GoogleTranslate($locale);
        $tr->setOptions(['verify' => false]); // Désactiver la vérification SSL
        return $tr->translate($text);
    });

    // ✅ Transformer tout en minuscules, puis mettre la 1ère lettre en majuscule
   // $translated = mb_strtolower($translated);
    $translated = mb_strtoupper(mb_substr($translated, 0, 1)) . mb_substr($translated, 1);

    return $translated;
}




    public static function TranslateText($text)
    {
        $locale = app()->getLocale();

        if ($locale == "fr" || empty($text)) {
            return $text;
        }

        $cacheKey = 'translation_' . md5($text . '_' . $locale);

        return cache()->remember($cacheKey, now()->addDays(7), function () use ($text, $locale) {
            $tr = new GoogleTranslate($locale);
            $tr->setOptions(['verify' => false]); // Désactiver la vérification SSL
            return $tr->translate($text);
        });
    }
}
