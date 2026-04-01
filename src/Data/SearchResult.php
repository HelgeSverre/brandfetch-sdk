<?php

namespace HelgeSverre\Brandfetch\Data;

use Illuminate\Support\Collection;
use Saloon\Http\Response;
use Spatie\LaravelData\Data;

class SearchResult extends Data
{
    public function __construct(
        public ?string $name,
        public string $domain,
        public bool $claimed,
        // The documentation is wrong, this is always a string
        public ?string $icon,
    ) {}

    /**
     * @return Collection<int, SearchResult>
     */
    public static function fromResponse(Response $response): Collection
    {
        return self::collect($response->json(), Collection::class);
    }
}
