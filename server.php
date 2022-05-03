<?php

/**
ID verification API

National ID
International Passport
NIN
vOTERS CARD 
DRIVER lISCENCE
GOVERNMENT api For ID Number Verification.

Delete Third party sold property after one month
Delete Posted property after 6months of dormancy
Username: administrator
Pass: email@admin

1000GB = TB
1GB = $0.023
50TB * 1000 = 50000GB

Profile on property listing
Currency list.

Agents
RC
Company name
Company Logo
Website URL

Certifications
Intitution, year, type (Bsc)

Services - Agent, Dealer, Artisan

Certified agents

Artisan
Max of 3 skills
Major minor skills
Description
Phone

Company subscription from individual
Comapny upgrading as partner

Featured ads shows more than others
Credit $1 costs 10units for 1week
*/

/**
php artisan route:clear
php artisan view:clear
php artisan config:clear
php artisan cache:clear
composer dumpautoload
*/

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';
