<?php

namespace HelgeSverre\Brandfetch\Data;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class Logo extends Data
{
    public function __construct(
        public ?string $theme,
        #[DataCollectionOf(Format::class)]
        public array $formats,
        public array $tags,
        public string $type
    ) {
    }
}
