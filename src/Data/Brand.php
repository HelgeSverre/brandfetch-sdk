<?php

namespace HelgeSverre\Brandfetch\Data;

use Saloon\Http\Response;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;

class Brand extends Data
{
    /**
     * @param  array|Link[]  $links
     * @param  array|Logo[]  $logos
     * @param  array|Color[]  $colors
     * @param  array|Font[]  $fonts
     * @param  array|Image[]  $images
     */
    public function __construct(
        public string $name,
        public string $domain,
        public bool $claimed,
        public ?string $description,
        public ?string $longDescription,
        #[DataCollectionOf(Link::class)]
        public ?array $links = null,
        #[DataCollectionOf(Logo::class)]
        public ?array $logos = null,
        #[DataCollectionOf(Color::class)]
        public ?array $colors = null,
        #[DataCollectionOf(Font::class)]
        public ?array $fonts = null,
        #[DataCollectionOf(Image::class)]
        public ?array $images = null
    ) {
    }

    public static function fromResponse(Response $response): self
    {
        return self::from($response->json());
    }
}
