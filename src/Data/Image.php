<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class Image extends Data
{
    public function __construct(
        #[DataCollectionOf(Format::class)]
        public DataCollection $formats,
        public array $tags,
        public string $type
    ) {
    }
}
