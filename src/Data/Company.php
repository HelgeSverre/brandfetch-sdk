<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Company extends Data
{
    /**
     * @param  array<string>|null  $industries
     */
    public function __construct(
        public ?string $employees,
        public ?int $foundedYear,
        public ?array $industries,
        public ?string $kind,
        public ?Location $location,
    ) {}
}
