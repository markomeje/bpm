<?php
/**
 * @see https://github.com/artesaos/seotools
 */

$title = 'Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease';
$description = 'Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease';

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => $title,
            'titleBefore'  => false,
            'description'  => $description,
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => url()->full(),
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => $title,
            'description' => $description,
            'url'         => url()->current(),
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary',
            'site'        => '@besproeprtymarket',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => $title,
            'description' => $description,
            'url'         => url()->current(),
            'type'        => 'WebPage',
            'images'      => [],
        ],
    ],
];
