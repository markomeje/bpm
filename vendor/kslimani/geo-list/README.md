# geo-list

A simple tiny _PHP only_ version of the awesome [umpirsky](https://github.com/umpirsky)'s [country-list](https://github.com/umpirsky/country-list), [currency-list](https://github.com/umpirsky/currency-list) and [language-list](https://github.com/umpirsky/language-list) projects.

This package is used by [laravel-geo](https://github.com/kslimani/laravel-geo) and the main goal is to reduce dependencies size. _(ie: composer download time and size)_

## Installation

use Composer to add the package to your project's dependencies :

```bash
composer require kslimani/geo-list
```

## Quick usage

```php
use Sk\Geo\GeoList;

// Get countries for 'en_US'
$countries = GeoList::countries('en_US');

// Get currencies for 'en_US'
$currencies = GeoList::currencies('en_US');

// Get languages with fallback locale (will fail for "foo_BAR")
$languages = GeoList::languages('foo_BAR', 'fr_FR');
```
