# Sentry Cron Job Monitoring for Scheduled Jobs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/modernmcguire/sentry-cron-monitoring-laravel.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/sentry-cron-monitoring-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/modernmcguire/sentry-cron-monitoring-laravel.svg?style=flat-square)](https://packagist.org/packages/modernmcguire/sentry-cron-monitoring-laravel)

A helper package to utilize the [Cron Job monitoring tool](https://docs.sentry.io/product/crons/) from Sentry.

> **Warning**
> Sentry Cron Job monitoring is still in beta

## Installation

You can install the package via composer:

```bash
composer require lionmm/sentry-cron-monitoring-laravel
```

Then publish the config file with:

```bash
php artisan vendor:publish --provider="LionMM\SentryCronMonitoringLaravel\SentryCronMonitoringLaravelServiceProvider"
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

This will add the `before`, `onSuccess` and `onFailure` calls necessary to track the job in Sentry.


### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email ben@modernmcguire.com instead of using the issue tracker.

## Credits

- [Ben Miller](https://github.com/modernmcguire)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
