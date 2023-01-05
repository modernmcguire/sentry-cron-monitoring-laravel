<?php

namespace Modernmcguire\SentryCronMonitoringLaravel;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;

class SentryCronMonitoringLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('sentry-cron-monitoring-laravel.php'),
            ], 'config');
        }

        Event::macro('monitor', function($monitor_id) {
            $uri = config('sentry-cron-monitoring-laravel.base_uri');
            $dsn = config('sentry-cron-monitoring-laravel.dsn');

            /** @var \Illuminate\Console\Scheduling\Event $event */
            $event = $this;

            if(!$dsn) {
                Log::error('Sentry DSN not found. Please add it to your .env file.');
                return $event;
            }

            return $event->before(function () use ($uri, $dsn, $monitor_id) {
                Http::withToken($dsn, 'DSN')
                ->post($uri . $monitor_id . '/checkins/', [
                    'status' => 'in_progress',
                ]);
            })
            ->after(function () use ($uri, $dsn, $monitor_id) {
                Http::withToken($dsn, 'DSN')
                ->put($uri . $monitor_id . '/checkins/latest/', [
                    'status' => 'ok',
                ]);
            });
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'sentry-cron-monitoring-laravel');
    }
}
