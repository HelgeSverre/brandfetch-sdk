![Brandfetch SDK](art/header.png)

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

### Retrieve a brand as a DTO

You can alternatively use the `->dto()` method to retireve a Spatie/Data DTO Object, which provides better auto-complete
support etc.

```php
$brand = Brandfetch::retrieveBrand("brandfetch.com")->dto()
```

#### Response DTO

The `retrieveBrand()->dto()` method returns a `Brand` DTO with the following properties:

- `name`: ?string - The name of the brand.
- `domain`: string - The domain associated with the brand.
- `claimed`: bool - Whether the brand has been claimed.
- `description`: ?string - A short description of the brand.
- `longDescription`: ?string - A longer description of the brand.
- `links`: ?DataCollection of `Link` - A collection of links related to the brand, each containing:
    - `name`: string - The name of the link.
    - `url`: string - The URL of the link.
- `logos`: ?DataCollection of `Logo` - A collection of logos associated with the brand, each containing:
    - `theme`: ?string - The theme of the logo.
    - `formats`: DataCollection of `Format` - The available formats of the logo, each containing:
        - `src`: string - The source URL of the format.
        - `background`: ?string - The background color of the format.
        - `format`: string - The format type (e.g., 'png', 'svg').
        - `size`: ?int - The size of the format.
        - `height`: ?int - The height of the format.
        - `width`: ?int - The width of the format.
    - `tags`: array - Tags associated with the logo.
    - `type`: string - The type of the logo.
- `colors`: ?DataCollection of `Color` - A collection of colors used by the brand, each containing:
    - `hex`: string - The HEX code of the color.
    - `type`: string - The type of the color (e.g., 'primary', 'secondary').
    - `brightness`: int - The brightness of the color.
- `fonts`: ?DataCollection of `Font` - A collection of fonts used by the brand, each containing:
    - `name`: ?string - The name of the font.
    - `type`: ?string - The type of the font.
    - `origin`: ?string - The origin of the font.
    - `originId`: ?string - The origin ID of the font.
- `images`: ?DataCollection of `Image` - A collection of images associated with the brand, each containing:
    - `formats`: DataCollection of `Format` - The available formats of the image, each containing:
        - `src`: string - The source URL of the format.
        - `background`: ?string - The background color of the format.
        - `format`: string - The format type (e.g., 'png', 'svg').
        - `size`: ?int - The size of the format.
        - `height`: ?int - The height of the format.
        - `width`: ?int - The width of the format.
    - `tags`: array - Tags associated with the image.
    - `type`: string - The type of the image.

### Search for a Brand

```php
$brand = Brandfetch::searchBrand("brandfetch.com")->dto()
```

#### Response DTO

The `searchBrand()->dto()` method returns a collection of `SearchResult` DTOs:

- `name`: ?string - The name of the brand.
- `domain`: string - The domain associated with the brand.
- `claimed`: bool - Whether the brand has been claimed.
- `icon`: ?string - The icon of the brand.

You can take a look at the DTOs [here](./src/Data/Brand.php)

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

