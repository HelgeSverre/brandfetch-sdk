<?php

/** @noinspection PhpUnhandledExceptionInspection */

use GuzzleHttp\Psr7\Uri;
use HelgeSverre\Brandfetch\Brandfetch;
use HelgeSverre\Brandfetch\Data\Brand;
use HelgeSverre\Brandfetch\Data\SearchResult;
use Illuminate\Support\Collection;
use Spatie\LaravelData\DataCollection;

beforeEach(function () {
    $apiKey = $_ENV['BRANDFETCH_API_KEY'] ?? env('BRANDFETCH_API_KEY', '');

    if (empty($apiKey) || $apiKey === 'fake-api-key') {
        $this->markTestSkipped('BRANDFETCH_API_KEY not set to a real key — skipping integration tests.');
    }

    $this->brandfetch = new Brandfetch(apiKey: $apiKey);
});

it('retrieves a brand and maps it to a Brand DTO', function () {
    /** @var Brand $dto */
    $dto = $this->brandfetch->retrieveBrand('brandfetch.com')->dto();

    expect($dto)->toBeInstanceOf(Brand::class)
        ->and($dto->domain)->toBe('brandfetch.com')
        ->and($dto->name)->toBe('Brandfetch')
        ->and($dto->logos)->toBeInstanceOf(DataCollection::class)->not->toBeEmpty()
        ->and($dto->colors)->toBeInstanceOf(DataCollection::class)->not->toBeEmpty()
        ->and($dto->fonts)->toBeInstanceOf(DataCollection::class)->not->toBeEmpty()
        ->and($dto->links)->toBeInstanceOf(DataCollection::class);
});

it('accepts a Guzzle Uri object as the domain argument', function () {
    $dto = $this->brandfetch->retrieveBrand(new Uri('https://brandfetch.com/some/path'))->dto();

    expect($dto)->toBeInstanceOf(Brand::class)
        ->and($dto->domain)->toBe('brandfetch.com');
});

it('returns a 404 response for an unknown domain', function () {
    $response = $this->brandfetch->retrieveBrand('this-domain-does-not-exist-xyzzy-brandfetch.com');

    expect($response->status())->toBe(404);
});

it('searches for brands and returns a collection of SearchResult DTOs', function () {
    /** @var Collection<int, SearchResult> $results */
    $results = $this->brandfetch->searchBrand('google')->dto();

    expect($results)->toBeInstanceOf(Collection::class)
        ->and($results->count())->toBeGreaterThan(0);

    $domains = $results->pluck('domain');
    expect($domains->some(fn (string $domain) => str_contains($domain, 'google')))->toBeTrue();

    $first = $results->first();
    expect($first)->toBeInstanceOf(SearchResult::class)
        ->and($first->name)->toBeString()->not->toBeEmpty()
        ->and($first->claimed)->toBeBool()
        ->and($first->domain)->toBeString()->not->toBeEmpty();
});

it('returns an empty collection for a search with no results', function () {
    $results = $this->brandfetch->searchBrand('zzzzzzz-no-results-xyzzy-12345')->dto();

    expect($results)->toBeInstanceOf(Collection::class)
        ->and($results->count())->toBe(0);
});

it('returns a logo URL via the convenience method', function () {
    $url = $this->brandfetch->logo('github.com');

    expect($url)->toBeString()->toStartWith('https://');
});

it('returns null from logo() for an unknown domain', function () {
    $url = $this->brandfetch->logo('this-domain-does-not-exist-xyzzy-brandfetch.com');

    expect($url)->toBeNull();
});
