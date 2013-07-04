# Intl

This library contains useful helpers for easing internationalization in a PHP application

## Locale

This component provides a complete list (including meta information) for all locales.  The list is built from the
http://www.localeplanet.com/ API and is contained in `resources/locales.php`.

### Usage

```php
// Provides the locales from the php resource
\Zenstruck\Intl\Locale::getAvailableLocales()

// Provides the locales as an assoc. array with the code as the key and name as the value
// Useful for a dropdown locale selector
\Zenstruck\Intl\Locale::getLocaleNames()

// Provides information for either the provided or default locale
\Zenstruck\Intl\Locale::getLocale('en_US')
\Zenstruck\Intl\Locale::getLocale()

// Provides only locales with both language and region set (ie "en_US", not "en")
\Zenstruck\Intl\Locale::getLocalesWithRegions()

// Provides the regions as an assoc. array with the code as the key and name as the value
\Zenstruck\Intl\Locale::getLocalesWithRegionNames()

// Provides language-only locales (ie "en", not "en_US")
\Zenstruck\Intl\Locale::getLanguages()

// Provides the languages as an assoc. array with the code as the key and name as the value
\Zenstruck\Intl\Locale::getLanguageNames()

// Provide the 3 digit ISO 4217 currency code for either the provided or default locale
\Zenstruck\Intl\Locale::getCurrency('en_US')
\Zenstruck\Intl\Locale::getCurrency()

// Provide the currency symbol for either the provided or default locale
\Zenstruck\Intl\Locale::getCurrencySymbol('en_US')
\Zenstruck\Intl\Locale::getCurrencySymbol()
```

## Resources

The full locale list is available in the following formats:

* **PHP**: `resources/locales.php`
* **JSON**: `resources/locales.json`

## Build JSON/PHP resources

```
composer install --dev

php bin/build.php
```

## Run Test Suite

```
composer install --dev

phpunit
```

