<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Font extends Data
{
    public function __construct(
        public ?string $name,
        public ?string $type,
        public ?string $origin,
        public ?string $originId,
    ) {
    }
}
