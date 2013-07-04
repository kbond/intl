<?php

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 */
class LocaleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider localeProvider
     */
    public function testGetAvailableLocales($code)
    {
        $locales = \Zenstruck\Intl\Locale::getAvailableLocales();

        $this->assertArrayHasKey($code, $locales);
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLocaleNames($code, $name)
    {
        $names = \Zenstruck\Intl\Locale::getLocaleNames();

        $this->assertArrayHasKey($code, $names);
        $this->assertEquals($name, $names[$code]);
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLocale($code, $name)
    {
        $locale = \Zenstruck\Intl\Locale::getLocale($code);

        $this->assertEquals($name, $locale['name']);
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetDefaultLocale($code, $name)
    {
        \Locale::setDefault($code);

        $locale = \Zenstruck\Intl\Locale::getLocale();

        $this->assertEquals($name, $locale['name']);
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLocalsWithRegions($code)
    {
        $regions = \Zenstruck\Intl\Locale::getLocalesWithRegions();

        if (strlen($code) === 2) {
            $this->assertArrayNotHasKey($code, $regions);
        } else {
            $this->assertArrayHasKey($code, $regions);
        }
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLocalesWithRegionNames($code, $name)
    {
        $names = \Zenstruck\Intl\Locale::getLocalesWithRegionNames();

        if (strlen($code) === 2) {
            $this->assertArrayNotHasKey($code, $names);
        } else {
            $this->assertArrayHasKey($code, $names);
            $this->assertEquals($name, $names[$code]);
        }
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLanguages($code)
    {
        $regions = \Zenstruck\Intl\Locale::getLanguages();

        if (strlen($code) === 2) {
            $this->assertArrayHasKey($code, $regions);
        } else {
            $this->assertArrayNotHasKey($code, $regions);
        }
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetLanguageNames($code, $name)
    {
        $names = \Zenstruck\Intl\Locale::getLanguageNames();

        if (strlen($code) === 2) {
            $this->assertArrayHasKey($code, $names);
            $this->assertEquals($name, $names[$code]);
        } else {
            $this->assertArrayNotHasKey($code, $names);
        }
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetCurrency($code, $name, $currency)
    {
        $this->assertEquals($currency, \Zenstruck\Intl\Locale::getCurrency($code));
    }

    /**
     * @dataProvider localeProvider
     */
    public function testGetCurrencySymbol($code, $name, $currency, $symbol)
    {
        $this->assertEquals($symbol, \Zenstruck\Intl\Locale::getCurrencySymbol($code));
    }

    public function localeProvider()
    {
        return array(
            array('en', 'English', '', '¤'),
            array('en_GB', 'English (United Kingdom)', 'GBP', '£'),
            array('fr_CA', 'français (Canada)', 'CAD', '$'),
            array('fr', 'français', '', '¤'),
            array('fr_FR', 'français (France)', 'EUR', '€'),
            array('ja_JP', '日本語(日本)', 'JPY', '￥')
        );
    }
}