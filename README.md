# Sentry Cron Job Monitoring for Scheduled Jobs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/modernmcguire/sentry-cron-monitoring-laravel.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/sentry-cron-monitoring-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/modernmcguire/sentry-cron-monitoring-laravel.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/sentry-cron-monitoring-laravel)
![GitHub Actions](https://github.com/modernmcguire/sentry-cron-monitoring-laravel/actions/workflows/main.yml/badge.svg)

A helper package to utilize the [Cron Job monitoring tool](https://docs.sentry.io/product/crons/) from Sentry.

> **Note** Sentry Cron Job monitoring is still in beta

## Installation

You can install the package via composer:

```bash
composer require modernmcguire/sentry-cron-monitoring-laravel
```

Then publish the config file with:

```bash
php artisan vendor:publish --provider="Modernmcguire\SentryCronMonitoringLaravel\SentryCronMonitoringLaravelServiceProvider"
```

## Usage

Add the following macro to your scheduled job that you would like to track.
```php
$schedule->call(function () {
    DB::table('recent_users')->delete();
})
->monitor('monitor-id-from-sentry')
->daily();
```

This will add the `before` and `after` calls necessary to track the job in Sentry.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ben@modernmcguire.com instead of using the issue tracker.

## Credits

-   [Ben Miller](https://github.com/modernmcguire)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
