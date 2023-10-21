![Brandfetch SDK](.github/header.png)

# Laravel SDK for Brandfetch

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/brandfetch-sdk.svg?style=flat-square)](https://packagist.org/packages/helgesverre/brandfetch-sdk)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/helgesverre/brandfetch-sdk/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/helgesverre/brandfetch-sdk/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/brandfetch-sdk.svg?style=flat-square)](https://packagist.org/packages/helgesverre/brandfetch-sdk)

Laravel SDK for interacting with the [Brandfetch API](https://docs.brandfetch.com/reference/get-started), get your API
key from the [developer portal](https://developers.brandfetch.com/).

## Installation

You can install the package via composer:

```bash
composer require helgesverre/brandfetch-sdk
```

Then add your API key to your `.env` file.

```
BRANDFETCH_API_KEY="your-api-key"
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="brandfetch-sdk-config"
```

This is the contents of the published config file:

```php
return [
    "brandfetch_api_key" => env("BRANDFETCH_API_KEY")
];
```

## Usage

### Retrieve a brand

```php
// Create your own instance
$brandfetch = new HelgeSverre\Brandfetch(apiKey: "your-api-key");

// Or use the facade
use HelgeSverre\Brandfetch\Facades\Brandfetch;

$brand = Brandfetch::retrieveBrand("brandfetch.com")->json()
```

You can alternatively use the `->dto()` method to retireve a Spatie/Data DTO Object, which provides better auto-complete
support etc.

```php
$brand = Brandfetch::retrieveBrand("brandfetch.com")->dto()
```

You can take a look at the DTOs [here](./src/Data/Brand.php)

### Search for a Brand

```php
$brand = Brandfetch::searchBrand("brandfetch.com")->dto()
```

## Testing

```bash
composer test
```

## Credits

- [Helge Sverre](https://github.com/HelgeSverre)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Disclaimer

**NOTE: This is not an official product from Brandfetch.**

All logos, brands, and trademarks mentioned herein belong to their respective owners. The "Brandfetch" name, logo, and
brand are trademarks of "Brandfetch SA". This project and its creator are not affiliated with, endorsed by, sponsored
by, or associated with "Brandfetch SA" or any other entities mentioned in this documentation. All rights reserved to the
respective trademark owners. Use of these names, logos, and brands does not imply endorsement and is purely
illustrative.

