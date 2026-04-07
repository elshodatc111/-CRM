<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schedule;
// * * * * * cd /var/www/loyiha-nomi && php artisan schedule:run >> /dev/null 2>&1
Schedule::command('child_payment:update')->everyFiveMinutes();

