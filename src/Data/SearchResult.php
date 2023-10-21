<?php

namespace HelgeSverre\Brandfetch\Data;

use Saloon\Http\Response;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class SearchResult extends Data
{
    public function __construct(
        public ?string $name,
        public string $domain,
        public bool $claimed,
        // The documentation is wrong, this is always a string
        public ?string $icon
    ) {
    }

    public static function fromResponse(Response $response): DataCollection
    {
        return self::collection($response->json());
    }
}
