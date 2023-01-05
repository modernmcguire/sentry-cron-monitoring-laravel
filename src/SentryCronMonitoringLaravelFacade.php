<?php

namespace Modernmcguire\SentryCronMonitoringLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Modernmcguire\SentryCronMonitoringLaravel\Skeleton\SkeletonClass
 */
class SentryCronMonitoringLaravelFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'sentry-cron-monitoring-laravel';
    }
}
