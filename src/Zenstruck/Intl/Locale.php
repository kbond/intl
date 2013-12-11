<?php

namespace Zenstruck\Intl;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class Locale
{
    const DEFAULT_LOCALE = 'en_US';

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

        return self::$locales = require_once(__DIR__ . '/../../../resources/locales.php');
    }

    /**
     * Provides the locales as an assoc. array with the code as the key and name as the value
     *
     * @return array
     */
    public static function getLocaleNames()
    {
        return array_map(function ($value) {
                return $value['name'];
            }, self::getAvailableLocales()
        );
    }

    /**
     * Provides only locales with both language and region set (ie "en_US", not "en")
     *
     * @return array
     */
    public static function getLocalesWithRegions()
    {
        return array_filter(Locale::getAvailableLocales(), function ($value) {
                return $value['country'] !== '';
            }
        );
    }

    /**
     * Provides the regions as an assoc. array with the code as the key and name as the value
     *
     * @return array
     */
    public static function getLocalesWithRegionNames()
    {
        return array_map(function ($value) {
                return $value['name'];
            },
            self::getLocalesWithRegions()
        );
    }

    /**
     * Provides language-only locales (ie "en", not "en_US")
     *
     * @return array
     */
    public static function getLanguages()
    {
        return array_filter(Locale::getAvailableLocales(), function ($value) {
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
        return array_map(function ($value) {
                return $value['name'];
            },
            self::getLanguages()
        );
    }

    /**
     * Provides information for either the provided or default locale
     *
     * @param string|null $locale
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    public static function getLocale($locale = null)
    {
        $locales = self::getAvailableLocales();

        if (!$locale) {
            $locale = self::getDefaultLocale();
        }

        if (!isset($locales[$locale])) {
            throw new \InvalidArgumentException(sprintf('The locale "%s" is not available.', $locale));
        }

        return $locales[$locale];
    }

    /**
     * Provide the 3 digit ISO 4217 currency code for either the provided or default locale
     *
     * @param string|null $locale
     *
     * @return mixed
     */
    public static function getCurrency($locale = null)
    {
        $locale = self::getLocale($locale);

        return $locale['currency'];
    }

    /**
     * Provide the currency symbol for either the provided or default locale
     *
     * @param string|null $locale
     *
     * @return mixed
     */
    public static function getCurrencySymbol($locale = null)
    {
        $locale = self::getLocale($locale);

        return $locale['currency_symbol'];
    }

    protected static function getDefaultLocale()
    {
        if (!class_exists('\Locale')) {
            return static::DEFAULT_LOCALE;
        }

        return \Locale::getDefault();
    }
}
