<?php

namespace Zenstruck\Intl;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class Locale
{
    protected static $locales = null;

    /**
     * Provides the locales from the json resource
     *
     * @return array
     */
    public static function getAvailableLocales()
    {
        if (self::$locales) {
            return self::$locales;
        }

        return self::$locales = json_decode(file_get_contents(__DIR__ . '/../../../resources/locales.json'), true);
    }

    /**
     * Provides the locales as an assoc. array with the code as the key and name as the value
     *
     * @return array
     */
    public static function getLocaleNames()
    {
        return array_map(function($value) {
                return $value['name'];
            }, self::getAvailableLocales()
        );
    }

    /**
     * Provides information for a locale
     *
     * @param string $locale
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public static function getLocale($locale)
    {
        $locales = self::getAvailableLocales();

        if (!isset($locales[$locale])) {
            throw new \InvalidArgumentException(sprintf('The locale "%s" is not available', $locale));
        }

        return $locales[$locale];
    }
}