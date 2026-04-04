<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Child; 
use Carbon\Carbon;

class ViewServiceProvider extends ServiceProvider{
    public function boot(): void{
        View::composer('*', function ($view) {
            $today = Carbon::today();
            $birthdayCount = Child::whereMonth('tkun', $today->month)->whereDay('tkun', $today->day)->count();
            $view->with('birthdayCount', $birthdayCount);
        });
    }
}
