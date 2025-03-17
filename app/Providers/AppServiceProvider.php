<?php

namespace App\Providers;

use App\Console\Commands\AttendanceReportMailSender;
use App\Console\Commands\AutoAbsentMarker;
use App\Console\Commands\AutoCheckoutMarker;
use App\Console\Commands\PollZkDevice;
use App\Console\Commands\ZkAttendances;
use App\Console\Commands\ZkTecoAutoTimeSet;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Schedule $schedule): void
    {

        $schedule->command(PollZkDevice::class)->everyMinute();
        $schedule->command(ZkAttendances::class)->everySecond();
        $schedule->command(AttendanceReportMailSender::class)->everyMinute();
        $schedule->command(ZkTecoAutoTimeSet::class)->everyMinute();
        $schedule->command(AutoCheckoutMarker::class)->everySecond();
        $schedule->command(AutoAbsentMarker::class)->everySecond();

        if (env('APP_PROTOCOL') === "https") {
            URL::forceScheme('https');
        } else if (env('APP_PROTOCOL') === "http") {
            URL::forceScheme('http');
        }

        Gate::before(function ($user) {
            return $user->hasRole("admin") ? true : false;
        });
    }
}
