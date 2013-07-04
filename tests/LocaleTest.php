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

    public function localeProvider()
    {
        return array(
            array('en', 'English'),
            array('en_GB', 'English (United Kingdom)'),
            array('fr_CA', 'français (Canada)'),
            array('fr', 'français'),
            array('fr_FR', 'français (France)'),
            array('ja_JP', '日本語(日本)')
        );
    }
}