<?php

use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

if (env('APP_ENV') === 'production') {
    Artisan::command('migrate:fresh', function () {
        $this->comment('You are not allowed to run this command.');
    })->describe('Disallow `php artisan migrate:fresh` command.');
}
