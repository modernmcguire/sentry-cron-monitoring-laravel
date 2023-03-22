<?php

return [
    /**
     * The Sentry DSN to use for monitoring.
     */
    'dsn' => env('SENTRY_LARAVEL_DSN', env('SENTRY_DSN')),

    /**
     * The Base URI for the Sentry Cron Monitor API
     */
    'base_uri' => env('SENTRY_MONITORS_URL', 'https://sentry.io/api/0/monitors/'),
];
