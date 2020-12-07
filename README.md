# A PHP framework agnostic package for Transmission

![Tests](https://github.com/intvent/transmission-api/workflows/Tests/badge.svg) ![Psalm](https://github.com/intvent/transmission-api/workflows/Psalm/badge.svg)

With this package you can easily integrate Transmission Webservice within your PHP project.  
If you wish to use this package and want to support future development. Please consider to [sponsor](https://github.com/sponsors/petericebear).  

## Installation

You can install the package via composer:

```bash
composer require intvent/transmission-api
```

## Usage

``` php
$username = 'username';
$sec_code_1 = 'sec_code_1';
$sec_code_2 = 'sec_code_2';

$client = new IntVent\Transmission\Client($username, $password);
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email info@intvent.nl instead of using the issue tracker.

## Credits

- [IntVent](https://github.com/IntVent)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
