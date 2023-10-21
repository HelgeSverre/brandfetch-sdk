<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Data;

class Format extends Data
{
    public function __construct(
        public string $src,
        public ?string $background,
        public string $format,
        public ?int $size,
        public ?int $height,
        public ?int $width
    ) {
    }
}
