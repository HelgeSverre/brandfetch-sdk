<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Color extends Data
{
    public function __construct(
        public string $hex,
        public string $type,
        public int $brightness
    ) {
    }
}
