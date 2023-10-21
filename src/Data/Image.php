<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class Image extends Data
{
    public function __construct(
        #[DataCollectionOf(Format::class)]
        public array $formats,
        public array $tags,
        public string $type
    ) {
    }
}
