<?php

namespace Sk\Geo;

class GeoList
{
    /**
     * Get localized data filename.
     *
     * @param  string  $type
     * @param  string  $locale
     * @return string
     */
    public static function file($type, $locale)
    {
        return implode('', [
            __DIR__,
            '/../data/',
            $type,
            '/',
            $locale,
            '/',
            $type,
            '.php',
        ]);
    }

    /**
     * Include localized data file.
     *
     * @param  string  $type
     * @param  string  $locale
     * @param  string  $fallbackLocale
     * @return array
     * @throws \LogicException
     */
    public static function include($type, $locale, $fallbackLocale = null)
    {
        $file = self::file($type, $locale);

        if (file_exists($file)) {
            return include $file;
        }

        if ($fallbackLocale) {
            $file = self::file($type, $fallbackLocale);

            if (file_exists($file)) {
                return include $file;
            }
        }

        throw new \LogicException(sprintf(
            'Failed to load %s data for %s',
            $type,
            $locale
        ));
    }

    /**
     * Get countries with ISO 3166-1 codes.
     *
     * @param  string  $locale
     * @param  string  $fallbackLocale
     * @return array
     */
    public static function countries($locale, $fallbackLocale = null)
    {
        return self::include('country', $locale, $fallbackLocale);
    }

    /**
     * Get currencies with ISO 4217 codes.
     *
     * @param  string  $locale
     * @param  string  $fallbackLocale
     * @return array
     */
    public static function currencies($locale, $fallbackLocale = null)
    {
        return self::include('currency', $locale, $fallbackLocale);
    }

    /**
     * Get languages with ISO 639-1 codes.
     *
     * @param  string  $locale
     * @param  string  $fallbackLocale
     * @return array
     */
    public static function languages($locale, $fallbackLocale = null)
    {
        return self::include('language', $locale, $fallbackLocale);
    }
}
