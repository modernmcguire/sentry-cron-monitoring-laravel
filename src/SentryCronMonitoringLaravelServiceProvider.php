<?php

namespace LionMM\SentryCronMonitoringLaravel;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class SentryCronMonitoringLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sentry-cron-monitoring.php'),
            ], 'config');
        }

        Event::macro('monitor', function ($monitorId) {
            $uri = config('sentry-cron-monitoring.base_uri');
            $dsn = config('sentry-cron-monitoring.dsn');

            /** @var \Illuminate\Console\Scheduling\Event $event */
            $event = $this;

            if (!$dsn) {
                Log::error('Sentry DSN not found. Please add it to your .env file.');

                return $event;
            }

            return $event
                ->before(function () use ($uri, $dsn, $monitorId) {
                    Http::withToken($dsn, 'DSN')
                        ->post($uri.$monitorId.'/checkins/', [
                            'status' => 'in_progress',
                        ]);
                })
                ->onSuccess(function () use ($uri, $dsn, $monitorId) {
                    Http::withToken($dsn, 'DSN')
                        ->put($uri.$monitorId.'/checkins/latest/', [
                            'status' => 'ok',
                        ]);
                })
                ->onFailure(function () use ($uri, $dsn, $monitorId) {
                    Http::withToken($dsn, 'DSN')
                        ->put($uri.$monitorId.'/checkins/latest/', [
                            'status' => 'error',
                        ]);
                });
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'sentry-cron-monitoring');
    }
}
