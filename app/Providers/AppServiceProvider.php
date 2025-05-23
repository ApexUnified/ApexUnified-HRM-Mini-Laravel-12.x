<?php

namespace App\Providers;

use App\Console\Commands\AttendanceReportMailSender;
use App\Console\Commands\AutoAbsentMarker;
use App\Console\Commands\AutoCheckoutMarker;
use App\Console\Commands\AutoSatSunAttendanceMarker;
use App\Console\Commands\ClearPayslipPdfFiles;
use App\Console\Commands\PollZkDevice;
use App\Console\Commands\ZkAttendances;
use App\Console\Commands\ZkTecoAutoTimeSet;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Pagination\Paginator;
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

        Paginator::useBootstrapFive();

        $schedule->command(PollZkDevice::class)->everyMinute();
        $schedule->command(ZkAttendances::class)->everySecond();
        $schedule->command(AttendanceReportMailSender::class)->everyMinute();
        $schedule->command(ZkTecoAutoTimeSet::class)->everyMinute();
        $schedule->command(AutoCheckoutMarker::class)->everySecond();
        $schedule->command(AutoAbsentMarker::class)->everyMinute();
        $schedule->command(ClearPayslipPdfFiles::class)->dailyAt("23:00");
        $schedule->command(AutoSatSunAttendanceMarker::class)->days([6, 7])->at("9:00");



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
