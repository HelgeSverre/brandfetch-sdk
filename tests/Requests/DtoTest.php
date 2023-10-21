<?php

/** @noinspection PhpUnhandledExceptionInspection */

use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Data\Brand;
use HelgeSverre\Brandfetch\Data\Color;
use HelgeSverre\Brandfetch\Data\Font;
use HelgeSverre\Brandfetch\Data\Image;
use HelgeSverre\Brandfetch\Data\Link;
use HelgeSverre\Brandfetch\Data\Logo;
use HelgeSverre\Brandfetch\Requests\RetrieveBrand;
use HelgeSverre\Brandfetch\Requests\SearchBrand;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;
use Spatie\LaravelData\DataCollection;

beforeEach(function () {
    $this->brandfetch = new Brandfetch(apiKey: env('BRANDFETCH_API_KEY', 'fake-api-key'));
});

it('SearchBrand returns a single result', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.single'),
    ]);

    $dto = $this->brandfetch->searchBrand('brandfetch.com', 'helgesver.re')->dto();

    expect($dto)->toBeInstanceOf(DataCollection::class)
        ->and($dto[0]->domain)->toBe('brandfetch.com')
        ->and($dto[0]->name)->toBe('Brandfetch');
});

it('SearchBrand returns a multiple results', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.multiple'),
    ]);

    $dto = $this->brandfetch->searchBrand('google', 'helgesver.re')->dto();

    expect($dto)->toBeInstanceOf(DataCollection::class)
        ->and($dto[0]->domain)->toBe('google.com')
        ->and($dto[0]->name)->toBe('Google');

});

it('SearchBrand returns no results', closure: function () {

    Saloon::fake([
        SearchBrand::class => MockResponse::fixture('searchBrand.empty'),
    ]);

    /** @var DataCollection $dto */
    $dto = $this->brandfetch->searchBrand('invalid-domain-should-fail-horribly', 'helgesver.re')->dto();

    expect($dto)->toBeInstanceOf(DataCollection::class)
        ->and($dto->count())->toBe(0);
});

it('RetrieveBrand returns complete response', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.full'),
    ]);

    /** @var Brand $dto */
    $dto = $this->brandfetch->retrieveBrand('brandfetch.com')->dto();

    expect($dto)->toBeInstanceOf(Brand::class)
        ->and($dto->domain)->toBe('brandfetch.com')
        ->and($dto->name)->toBe('Brandfetch')
        ->and($dto->links)->toBeInstanceOf(DataCollection::class)
        ->and($dto->links[0])->toBeInstanceOf(Link::class)
        ->and($dto->logos)->toBeInstanceOf(DataCollection::class)
        ->and($dto->logos[0])->toBeInstanceOf(Logo::class)
        ->and($dto->colors)->toBeInstanceOf(DataCollection::class)
        ->and($dto->colors[0])->toBeInstanceOf(Color::class)
        ->and($dto->fonts)->toBeInstanceOf(DataCollection::class)
        ->and($dto->fonts[0])->toBeInstanceOf(Font::class)
        ->and($dto->images)->toBeInstanceOf(DataCollection::class)
        ->and($dto->images[0])->toBeInstanceOf(Image::class);

    Saloon::assertSent('/v2/brands/brandfetch.com');
    Saloon::assertSent(RetrieveBrand::class);
});

it('RetrieveBrand returns response for autostrada.no', closure: function () {

    Saloon::fake([
        RetrieveBrand::class => MockResponse::fixture('retrieveBrand.brand-autostrada'),
    ]);

    $dto = $this->brandfetch->retrieveBrand('autostrada.no')->dto();

    expect($dto)->toBeInstanceOf(Brand::class)
        ->and($dto->domain)->toBe('autostrada.no')
        ->and($dto->name)->toBe('Autostrada');

    Saloon::assertSent('/v2/brands/autostrada.no');
    Saloon::assertSent(RetrieveBrand::class);
});
