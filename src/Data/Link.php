<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Link extends Data
{
    public function __construct(
        public string $name,
        public string $url
    ) {
    }
}
