# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-04-01

### Breaking Changes

- **Requires `saloonphp/saloon ^4.0`** — drops support for Saloon 3.x
- **Requires `saloonphp/laravel-plugin ^4.0`** — drops support for laravel-plugin 3.x
- **Drops Laravel 10 support** — `saloonphp/laravel-plugin ^4` requires `illuminate ^11+`; Laravel 10 consumers must stay on v1.x
- **`SearchResult::fromResponse()` now returns `Illuminate\Support\Collection`** instead of `Spatie\LaravelData\DataCollection` — update any code that type-hints the return value

### Added

- `transactionBrand(string $transactionLabel, string $countryCode = 'US'): Response` method on the `Brandfetch` connector
- `Brand` DTO fields: `qualityScore`, `isNsfw`, `stockTicker`, `isin`, `company` (new `Company` DTO)
- `Company` DTO with fields: `employees`, `foundedYear`, `industries`, `kind`, `location` (new `Location` DTO)
- `Location` DTO with fields: `city`, `state`, `country`, `countryCode`
- Laravel 13 support (`illuminate/contracts ^13.0`, `orchestra/testbench ^11.0`)
- Integration test suite covering live API behaviour (auto-skipped when `BRANDFETCH_API_KEY` is not a real key)

### Fixed

- Saloon CVE-2026-33942, CVE-2026-33183, CVE-2026-33182 — resolved by upgrading to Saloon 4.x
- Test fixture names migrated from dot-separator (`retrieveBrand.full`) to subdirectory structure (`retrieveBrand/full`) to comply with Saloon 4's fixture path validation (CVE-2026-33183 hardening)
- `logo()` parameter now correctly typed as `string` instead of untyped

## [1.1.0] - 2024-10-20

### Added

- Laravel 11 support

## [1.0.2] - 2023-11-01

### Fixed

- Minor fixes

## [1.0.1] - 2023-10-30

### Fixed

- Minor fixes

## [1.0.0] - 2023-10-21

### Added

- Initial release
- `retrieveBrand()` — fetch brand data by domain
- `searchBrand()` — search brands by name
- `logo()` — convenience method to get the first logo URL for a domain
