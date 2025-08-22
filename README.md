# Implements Clean Architecture with PHP

[![Latest Version on Packagist](https://img.shields.io/packagist/v/giacomomasseron/php-php-clean-architecture.svg?style=flat-square)](https://packagist.org/packages/giacomomasseron/php-php-clean-architecture)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/giacomomasseron/php-php-clean-architecture/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/giacomomasseron/php-php-clean-architecture/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/giacomomasseron/php-php-clean-architecture/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/giacomomasseron/php-php-clean-architecture/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/giacomomasseron/php-php-clean-architecture.svg?style=flat-square)](https://packagist.org/packages/giacomomasseron/php-php-clean-architecture)

Implements Clean Architecture as described by Robert C. Martin (Uncle Bob) here  
[Clean Architecture](https://blog.cleancoder.com/uncle-bob/2012/08/13/the-clean-architecture.html).

This package uses the concept of Use Cases.

## Installation

You can install the package via composer:

```bash
composer require giacomomasseron/php-clean-architecture
```

## Usage

If you want to create a use case, you can create a class that extends `\GiacomoMasseroni\FireAndForget\PHPCleanArchitecture` and implement the `handle` method:

```php
class DoSomethingUseCase extends GiacomoMasseroni\PHPCleanArchitecture\BaseUseCase
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Giacomo Masseroni](https://github.com/giacomomasseron)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
