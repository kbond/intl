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
     * Provides only locales with both language and region set (ie "en_US", not "en")
     *
     * @return array
     */
    public static function getRegions()
    {
        return array_filter(Locale::getAvailableLocales(), function($value) {
                return $value['country'] !== '';
            }
        );
    }

    /**
     * Provides the regions as an assoc. array with the code as the key and name as the value
     *
     * @return array
     */
    public static function getRegionNames()
    {
        return array_map(function($value) {
                return $value['name'];
            },
            self::getRegions()
        );
    }

    /**
     * Provides language-only locales (ie "en", not "en_US")
     *
     * @return array
     */
    public static function getLanguages()
    {
        return array_filter(Locale::getAvailableLocales(), function($value) {
                return $value['country'] === '';
            }
        );
    }

    /**
     * Provides the languages as an assoc. array with the code as the key and name as the value
     *
     * @return array
     */
    public static function getLanguageNames()
    {
        return array_map(function($value) {
                return $value['name'];
            },
            self::getLanguages()
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