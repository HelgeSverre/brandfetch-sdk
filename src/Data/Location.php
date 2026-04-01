<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Location extends Data
{
    public function __construct(
        public ?string $city,
        public ?string $state,
        public ?string $country,
        public ?string $countryCode
    ) {}
}
