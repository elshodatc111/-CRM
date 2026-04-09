<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
// * * * * * cd /var/www/loyiha-nomi && php artisan schedule:run >> /dev/null 2>&1
// /usr/local/bin/php /home/atkopane/public_html/artisan schedule:run >> /dev/null 2>&1
Schedule::command('child_payment:update')->everyFiveMinutes();
