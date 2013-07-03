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