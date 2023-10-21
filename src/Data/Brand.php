<?php

namespace HelgeSverre\Brandfetch\Data;

use Saloon\Http\Response;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

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
        public ?DataCollection $links = null,
        #[DataCollectionOf(Logo::class)]
        public ?DataCollection $logos = null,
        #[DataCollectionOf(Color::class)]
        public ?DataCollection $colors = null,
        #[DataCollectionOf(Font::class)]
        public ?DataCollection $fonts = null,
        #[DataCollectionOf(Image::class)]
        public ?DataCollection $images = null
    ) {
    }

    public static function fromResponse(Response $response): self
    {
        return self::from($response->json());
    }
}
